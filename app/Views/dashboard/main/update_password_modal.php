        <div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form onsubmit="event.preventDefault();">
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="new_password" placeholder="New Password" required>
                    <label for="new_password">New Password</label>
                  </div>
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                    <label for="confirm_password">Confirm Password</label>
                  </div>
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="old_password" placeholder="Old Password" required>
                    <label for="old_password">Old Password</label>
                  </div>
                  <button class="w-100 btn-lg btn-primary" type="submit" onclick="updatePassword();">SUBMIT</button>
                </form>
              </div>
            </div>
          </div>
        </div>
