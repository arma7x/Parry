      <div class="container">
        <h1 class="mt-5">Welcome to Parry Public <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
        <h4>Parent Class <?= $namespace; ?></h4>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-dark" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="firebaseui-auth-container" class="mt-5"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        ui.start('#firebaseui-auth-container', uiConfig)
      </script>
