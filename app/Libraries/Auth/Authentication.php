<?php

namespace App\Libraries\Auth;

use CodeIgniter\Database\BaseConnection;

class Authentication
{

	private $db;
	private $tableName = 'users';

	public function __construct(BaseConnection $db)
	{
		$this->db = $db;
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
			'0' => 'YES',
			'1' => 'NO',
		];
	}

	public static function STATUS(): ARRAY {
		return [
			'' => 'L_STATUS',
			'-1' => 'L_BAN',
			'0' => 'L_INACTIVE',
			'1' => 'L_ACTIVE',
		];
	}

	public function generatePasswordSafeLength($string): STRING {
		return base64_encode(hash('sha384', $string, TRUE));
	}

	public function getAllUsers($filters = [], $limit = 10, $offset = 0)
	{
		$builder = $this->db->table($this->tableName);
		if (COUNT($filters) > 0) {
			return $builder->where($filters)->limit($limit, $offset)->get();
		} else {
			return $builder->limit($limit, $offset)->get();
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
		return$this->db->table($this->tableName)->set($data)->where('id', $uid)->update();
	}

	public function deleteUser($uid): BOOL
	{
	}

	public function updatePassword($uid, $oldPassword, $newPassword)
	{
		$user = $this->findUser(['id' => $uid], 'password_hash');
		if ($user === NULL) {
			throw new \Exception('$UID not exist');
		}
		if ($this->verifyPassword($oldPassword, $user['password_hash'])) {
			$password_hash = password_hash($this->generatePasswordSafeLength($newPassword), TRUE);
			return $this->updateUser($uid, ['password_hash' => $password_hash]);
		} else {
			throw new \Exception('Old password does not match');
		}
	}

	// create_permission
	// read_permission
	// update_permission
	// delete_permission
	public function hasPermission($uid, $type, $value = 1): BOOL
	{
		$user = $this->findUser(['id' => $uid], $type);
		if ($user === NULL) {
			throw new \Exception('$UID not exist');
		}
		return (int) $user[$type] === $value;
	}

	public function login($username, $password): STRING
	{
		// password_verify($this->generatePasswordSafeLength('1234567890'), $current_password)
	}

	public function logout()
	{
	}
}
