<?php

namespace App\Libraries\Auth;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Session\SessionInterface;

class Authentication
{

	private $db;
	private $session;
	private $tableName = 'users';
	private $cookieName = 'auth';

	public function __construct(BaseConnection $db, SessionInterface $session)
	{
		$this->db = $db;
		$this->session = $session;
	}

	public static function LEVEL(): ARRAY {
		return [
			'' => 'L_ROLE',
			'0' => 'L_ADMIN',
			'1' => 'L_MODERATOR',
		];
	}

	public static function PERMISSION(): ARRAY {
		return [
			'' => 'L_PERMISSION',
			'0' => 'L_NO',
			'1' => 'L_YES',
		];
	}

	public static function STATUS(): ARRAY {
		return [
			'' => 'L_STATUS',
			'-1' => 'L_BANNED',
			'0' => 'L_INACTIVE',
			'1' => 'L_ACTIVE',
		];
	}

	public function generatePasswordSafeLength($string): STRING {
		return base64_encode(hash('sha384', $string, TRUE));
	}

	public function getAllUsers($filters = [], $limit = 10, $page = 1)
	{
		$offset = $page - 1;
		$builderCount = $this->db->table($this->tableName);
		$builder = $this->db->table($this->tableName);
		if (COUNT($filters) > 0) {
			foreach($filters as $n => $value) {
				if ($value !== NULL && $value !== '' && $n !== 'keyword') {
					$builder->where($n, $value);
					$builderCount->where($n, $value);
				} else if ($value !== NULL && $value !== '' && $n === 'keyword') {
					$builder->groupStart()->orLike('id', $value)->orLike('username', $value)->orLike('email', $value)->groupEnd();
					$builderCount->groupStart()->orLike('id', $value)->orLike('username', $value)->orLike('email', $value)->groupEnd();
				}
			}
			$total = $builderCount->countAllResults();
			return [
				'result' => $builder->limit($limit, $offset * $limit)->orderBy('created_at', 'DESC')->get()->getResult(),
				'prev_page' => $offset === 0 ? 0 : $page - 1,
				'current_page' => $page,
				'next_page' =>  $total > ($offset + 1) * $limit ? ($page + 1) : 0,
				'per_page' => $limit,
				'total' => $total,
			];
		} else {
			$total = $builderCount->countAll();
			return [
				'result' => $builder->limit($limit, $offset * $limit)->orderBy('created_at', 'DESC')->get()->getResult(),
				'prev_page' => $offset === 0 ? 0 : $page - 1,
				'current_page' => $page,
				'next_page' =>  $total > ($offset + 1) * $limit ? ($page + 1) : 0,
				'per_page' => $limit,
				'total' => $total,
			];
		}
	}

	public function findUser($filters = [], $select = '*')
	{
		$builder = $this->db->table($this->tableName);
		$builder->select($select);
		foreach($filters as $key => $value) {
			$builder->where($key, $value);
		}
		return $builder->get()->getRowArray();
	}

	public function addUser($data) {
		$builder = $this->db->table($this->tableName);
		$uid = bin2hex(random_bytes(7));
		$row = $builder->select('id')
					->where('id', $uid)
					->orWhere('username', strtolower($data['username']))
					->orWhere('email', strtolower($data['email']))
					->get()
					->getRowArray();
		if ($row !== NULL) {
			throw new \Exception('Duplicate id, username or email address');
		}
		$fields = [
			'id' => $uid,
			'username' => strtolower($data['username']),
			'email' => strtolower($data['email']),
			'password_hash' => password_hash($this->generatePasswordSafeLength($data['password']), TRUE),
			'level' => (int) $data['level'],
			'status' => (int) $data['status'],
			'create_permission' => (int) $data['create_permission'],
			'read_permission' => (int) $data['read_permission'],
			'update_permission' => (int) $data['update_permission'],
			'delete_permission' => (int) $data['delete_permission'],
			'created_at' => time(),
			'updated_at' => time(),
		];
		return $builder->set($fields)->insert();
	}

	public function verifyPassword($plainPassword, $passwordHash): BOOL
	{
		return password_verify($this->generatePasswordSafeLength($plainPassword), $passwordHash);
	}

	public function updateUser($uid, $data)
	{
		return $this->db->table($this->tableName)->set($data)->where('id', $uid)->update();
	}

	public function deleteUser($uid): BOOL
	{
		if ($this->db->table($this->tableName)->delete(['id' => $uid]) === FALSE)
			return FALSE;
		return TRUE;
	}

	public function updatePassword(Array $user, $oldPassword, $newPassword)
	{
		if ($this->verifyPassword($oldPassword, $user['password_hash'])) {
			$password_hash = password_hash($this->generatePasswordSafeLength($newPassword), TRUE);
			return $this->updateUser($user['id'], ['password_hash' => $password_hash]);
		} else {
			throw new \Exception('Old password is incorrect');
		}
	}

	public function validateMinLevel($uid, int $level): BOOL
	{
		$user = $this->findUser(['id' => $uid, 'level <=' => $level], 'level');
		if ($user === NULL) {
			return FALSE;
		}
		return TRUE;
	}

	// $type: create, read, update, delete
	public function hasPermission($uid, $type): BOOL
	{
		$type .= '_permission';
		$user = $this->findUser(['id' => $uid, $type => 1], $type);
		if ($user === NULL) {
			return FALSE;
		}
		return TRUE;
	}

	public function isLoggedIn()
	{
		$uid = $this->session->get('uid');
		if ($uid === NULL) {
			return FALSE;
		}
		$user = $this->findUser(['id' => $uid], 'id, username, password_hash, email, level, status, create_permission, read_permission, update_permission, delete_permission');
		if ($user === NULL) {
			$this->session->destroy();
			return FALSE;
		}
		if ((int) $user['status'] !== 1) {
			$this->session->destroy();
			return FALSE;
		}
		return $user;
	}

	public function login($username, $password)
	{
		if ($this->isLoggedIn($this->session) !== FALSE) {
			throw new \Exception('You already logged-in');
		}
		$user = $this->findUser(['username' => strtolower($username)], 'id, password_hash, status');
		if ($user === NULL) {
			throw new \Exception('User does not exist');
		}
		if ((int) $user['status'] !== 1) {
			throw new \Exception('User was banned or inactive, reason: '. $this::STATUS()[$user['status']]);
		}
		if (!$this->verifyPassword($password, $user['password_hash'])) {
			throw new \Exception('Login failed');
		}
		$this->session->set('uid', $user['id']);
		return $this->session->get('uid');
	}

	public function logout(): BOOL
	{
		$this->session->destroy();
		return TRUE;
	}
}
