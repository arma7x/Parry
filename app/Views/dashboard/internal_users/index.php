      <div class="container h-100">
        <h1 class="mt-2">Internal Users</h1>
        <div>
          <form class="row g-3" onsubmit="event.preventDefault();">
            <div class="col-sm">
              <div class="col-sm">
                <div class="input-group-sm mb-3">
                  <label for="s_keyword" class="w-100 text-start">Keyword</label>
                  <input id="s_keyword" type="text" class="form-control" aria-label="Keyword" aria-describedby="s_keyword">
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
                  <button class="w-50 btn-sm btn-success">INSERT</button>
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
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">Status</th>
                <th scope="col">Permission</th>
                <th scope="col">Activity</th>
              </tr>
            </thead>
            <tbody id="_iubody">
              <?php foreach($users['result'] as $u): ?>
              <tr>
                <th scope="row"><?= $u->id ?></th>
                <td class="text-start">
                  <div><?= $u->username ?></div>
                  <div><?= $u->email ?></div>
                </td>
                <td><?= $u->level ?></td>
                <td><?= $u->status ?></td>
                <td class="text-start">
                  <div>
                    <div style="font-size:90%;font-weight:bold;">Create</div>
                    <div><?= $u->create_permission ?></div>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Read</div>
                    <div><?= $u->read_permission ?></div>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Update</div>
                    <div><?= $u->update_permission ?></div>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Delete</div>
                    <div><?= $u->delete_permission ?></div>
                  </div>
                </td>
                <td class="text-start">
                  <div>
                    <div style="font-size:90%;font-weight:bold;">Created At</div>
                    <?= $u->created_at ?>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Last Update</div>
                    <?= $u->updated_at ?>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="container">
          <div class="row">
          <button id="s_prev_page" <?= (int) $users['prev_page'] === 0 ? 'disabled ' : '' ?>type="button" class="col btn btn-primary btn-sm" onclick="searchUser(this);" data-page="<?= $users['prev_page']; ?>">Prev</button>
          <div class="col input-group input-group-sm">
            <span class="input-group-text">Page</span>
            <select id="s_current_page" class="form-select form-select-sm" onchange="searchUser(this);">
              <?php for($i = 1;$i <= (int) (ceil((float) $users['total']/ (float) $users['per_page']));$i++): ?>
              <option value="<?= $i; ?>"<?= (int) $users['current_page'] === $i ? ' selected' : '' ?> onclick="searchUser(this);"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <button id="s_next_page" <?= (int) $users['next_page'] === 0 ? 'disabled ' : '' ?>type="button" class="col btn btn-primary btn-sm" onclick="searchUser(this);" data-page="<?= $users['next_page']; ?>">Next</button>
          </div>
        </div>
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
