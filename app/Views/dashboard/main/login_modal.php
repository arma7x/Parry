        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form onsubmit="event.preventDefault();">
                  <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="lg_username" placeholder="Username" required>
                    <label for="lg_username">Username</label>
                  </div>
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="lg_password" placeholder="Password" required>
                    <label for="lg_password">Password</label>
                  </div>
                  <button class="w-100 btn-lg btn-primary" type="submit" onclick="loginDashboard();">SUBMIT</button>
                </form>
              </div>
            </div>
          </div>
        </div>
