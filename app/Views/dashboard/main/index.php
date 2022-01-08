      <div class="container h-100">
        <?php if ($__user__ !== FALSE): ?>
        <h1 class="mt-5">Parry Dashboard <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <!-- <h4>Parent Class <?= $namespace; ?></h4> -->
        <div class="container">
          <div class="row">
            <?php for($i=1;$i<=16;$i++): ?>
            <div class="m-0 p-0 col-xs-12 col-md-4 col-lg-3">
              <div class="d-flex flex-column justify-content-center m-1 bg-light text-dark" style="height:140px;"><?= $i; ?> of 16</div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
        <?= view('dashboard/main/update_password_modal', $this->data); ?>
        <script type="text/javascript">
          window.addEventListener("load", function() {
            const headers = document.getElementsByTagName('header');
            if (headers.length > 0)
              headers[0].classList.remove('mb-auto');
          });
        </script>
        <?php else: ?>
        <h1 class="mt-5">Welcome to Parry Dashboard <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <!-- <h4>Parent Class <?= $namespace; ?></h4> -->
        <?= view('dashboard/main/login_modal', $this->data); ?>
        <?PHP endif ;?>
      </div>
