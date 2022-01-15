      <div class="container h-100">
        <h1 class="mt-2">Internal Users</h1>
        <div>
          <form class="row g-3" onsubmit="event.preventDefault();">
            <div class="col-sm">
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_keyword" class="w-100 text-start">Keyword</label>
                  <input id="s_keyword" type="text" class="form-control" aria-label="Keyword" aria-describedby="s_keyword" placeholder="Search by id, email or username">
                </div>
              </div>
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_level" class="w-100 text-start">Level</label>
                  <select id="s_level" class="form-select form-select-sm" aria-label="Level" aria-describedby="s_level">
                    <option value="">Omit</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_create_permission" class="w-100 text-start">Create Permission</label>
                  <select id="s_create_permission" class="form-select form-select-sm" aria-label="Create Permission" aria-describedby="s_create">
                    <option value="">Omit</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_read_permission" class="w-100 text-start">Read Permission</label>
                  <select id="s_read_permission" class="form-select form-select-sm" aria-label="Read Permission" aria-describedby="s_read">
                    <option value="">Omit</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_update_permission" class="w-100 text-start">Update Permission</label>
                  <select id="s_update_permission" class="form-select form-select-sm" aria-label="Update Permission" aria-describedby="s_update">
                    <option value="">Omit</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_delete_permission" class="w-100 text-start">Delete Permission</label>
                  <select id="s_delete_permission" class="form-select form-select-sm" aria-label="Delete Permission" aria-describedby="s_delete">
                    <option value="">Omit</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_status" class="w-100 text-start">Status</label>
                  <select id="s_status" class="form-select form-select-sm" aria-label="Status" aria-describedby="s_status">
                    <option value="">Omit</option>
                    <option value="-1">Banned</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
              <div class="col-sm">
                <label class="w-100"></label>
                <div class="row mx-1">
                  <button class="w-50 btn-sm btn-primary" type="submit" onclick="searchUser(this);" data-page="1">SEARCH</button>
                  <?php if ((int) $__user__['create_permission'] == 1): ?>
                  <button class="w-50 btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">CREATE</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="row mt-2 p-2 table-responsive">
          <table class="table table-bordered table-sm table-light text-dark">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Username/Email</th>
                <th scope="col">Metadata</th>
                <th scope="col">Permission</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody id="users_tbody">
            <?= view('dashboard/internal_users/users_tbody_widget', $this->data); ?>
            </tbody>
          </table>
        </div>
        <div id="users_pagination" class="container row p-0 m-0">
        <?= view('dashboard/internal_users/users_pagination_widget', $this->data); ?>
        </div>
        <?= view('dashboard/internal_users/user_create_widget', $this->data); ?>
        <script type="text/javascript">
          window.addEventListener("load", function() {
            var url = new URL(document.location.toString());
            url.searchParams.forEach((v, k) => {
              var field = document.getElementById(`s_${k}`);
              if (field != null)
                field.value = v;
            })
          });
        </script>
      </div>
