      <div class="container">
        <h1 class="mt-5">Welcome to Parry Dashboard <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <h4>Parent Class <?= $namespace; ?></h4>
        <?php if ($__user__ !== FALSE): ?>
        <?= view('dashboard_update_password_modal', $this->data); ?>
        <?php else: ?>
        <?= view('dashboard_login_modal', $this->data); ?>
        <?PHP endif ;?>
      </div>
