        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-dark" id="createUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form onsubmit="event.preventDefault();" novalidate>
                  <div class="input-group-sm mb-3 has-validatio">
                    <label for="c_username" class="w-100 text-start text-dark">Username</label>
                    <input id="c_username" type="text" class="form-control" aria-label="Username" aria-describedby="c_username" placeholder="Please enter username">
                    <div id="c_username_invalid" class="w-100 text-start invalid-feedback"></div>
                  </div>
                  <div class="input-group-sm mb-3">
                    <label for="c_email" class="w-100 text-start text-dark">Email</label>
                    <input id="c_email" type="email" class="form-control" aria-label="Email" aria-describedby="c_email" placeholder="Please enter email">
                    <div id="c_email_invalid" class="w-100 text-start invalid-feedback"></div>
                  </div>
                  <div class="input-group-sm mb-3">
                    <label for="c_password" class="w-100 text-start text-dark">Password</label>
                    <input id="c_password" type="text" class="form-control" aria-label="Password" aria-describedby="c_password" placeholder="Please enter password">
                    <div id="c_password_invalid" class="w-100 text-start invalid-feedback"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_create_permission" class="w-100 text-start text-dark">Create Permission</label>
                        <select id="c_create_permission" class="form-select form-select-sm" aria-label="Create Permission" aria-describedby="c_create">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_read_permission" class="w-100 text-start text-dark">Read Permission</label>
                        <select id="c_read_permission" class="form-select form-select-sm" aria-label="Read Permission" aria-describedby="c_read">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_update_permission" class="w-100 text-start text-dark">Update Permission</label>
                        <select id="c_update_permission" class="form-select form-select-sm" aria-label="Update Permission" aria-describedby="c_update">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_delete_permission" class="w-100 text-start text-dark">Delete Permission</label>
                        <select id="c_delete_permission" class="form-select form-select-sm" aria-label="Delete Permission" aria-describedby="c_delete">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_status" class="w-100 text-start text-dark">Status</label>
                        <select id="c_status" class="form-select form-select-sm" aria-label="Status" aria-describedby="c_status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                          <option value="-1">Banned</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="input-group-sm mb-3">
                        <label for="c_level" class="w-100 text-start text-dark">Level</label>
                        <select id="c_level" class="form-select form-select-sm" aria-label="Level" aria-describedby="c_level">
                          <option value="3">3</option>
                          <option value="2">2</option>
                          <option value="1">1</option>
                          <option value="0">0</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="w-100 btn-sm btn-primary" type="submit" onclick="createUser();">SUBMIT</button>
                </form>
              </div>
            </div>
          </div>
        </div>
