      <div class="container h-100">
        <?php if ($__user__ !== FALSE): ?>
        <h1 class="mt-2">Parry Dashboard <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <!-- <h4>Parent Class <?= $namespace; ?></h4> -->
        <div class="container">
          <div class="row">
            <?php if (isset($menus)): ?>
            <?php foreach($menus as $menu): ?>
            <div class="m-0 p-0 col-xs-12 col-md-4 col-lg-3" style="pointer:cursor;">
              <a href="<?= $menu['href']; ?>" class="d-flex flex-column justify-content-center m-1 bg-light text-dark h4" style="height:140px;"><?= $menu['text']; ?>
              </a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <?php else: ?>
        <h1 class="mt-2">Welcome to Parry Dashboard <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <!-- <h4>Parent Class <?= $namespace; ?></h4> -->
        <?= view('dashboard/main/login_modal', $this->data); ?>
        <?PHP endif ;?>
      </div>
