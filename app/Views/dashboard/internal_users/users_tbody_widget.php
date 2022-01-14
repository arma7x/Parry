              <?php foreach($users['result'] as $u): ?>
              <tr>
                <th class="text-start">
                  #ID <?= $u->id ?>
                  <div class="mt-2">
                    <div><small>Created At</small></div>
                    <span id="u_ca_<?= $u->id ?>" class="fw-normal"><?= date('Y-m-d H:i:s', $u->created_at) ?></span>
                  </div>
                  <div class="mt-2">
                    <div><small>Last Update</small></div>
                    <span id="u_lu_<?= $u->id ?>" class="fw-normal"><?= date('Y-m-d H:i:s', $u->updated_at) ?></span>
                  </div>
                </th>
                <td class="text-start">
                  <div>
                    <div class="fw-bold">Username</div>
                    <div><?= $u->username ?></div>
                  </div>
                  <div class="mt-2">
                    <div class="fw-bold">Email</div>
                    <div><?= $u->email ?></div>
                  </div>
                </td>
                <td class="text-start">
                  <div class="container row p-0 m-0">
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_c_perm_<?= $u->id ?>" class="input-group-text">Create</label>
                        <select id="u_c_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_c_perm">
                          <option value="0"<?= (int) $u->create_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->create_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                    </form>
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0 ms-1">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_r_perm_<?= $u->id ?>" class="input-group-text">Read</label>
                        <select id="u_r_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_r_perm">
                          <option value="0"<?= (int) $u->read_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->read_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                    </form>
                  </div>
                  <div class="container row p-0 m-0 my-3">
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_u_perm_<?= $u->id ?>" class="input-group-text">Update</label>
                        <select id="u_u_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_u_perm">
                          <option value="0"<?= (int) $u->update_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->update_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                    </form>
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0 ms-1">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_d_perm_<?= $u->id ?>" class="input-group-text">Delete</label>
                        <select id="u_d_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_d_perm">
                          <option value="0"<?= (int) $u->delete_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->delete_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                    </form>
                  </div>
                </td>
                <td class="text-start">
                  <form onsubmit="event.preventDefault();">
                    <div class="input-group input-group-sm mb-1">
                      <span for="u_level_<?= $u->id ?>" class="input-group-text">Level</span>
                      <select id="u_level_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_level">
                        <option value="0"<?= (int) $u->level === 0 ? ' selected' : '' ?>>0</option>
                        <option value="1"<?= (int) $u->level === 1 ? ' selected' : '' ?>>1</option>
                        <option value="2"<?= (int) $u->level === 2 ? ' selected' : '' ?>>2</option>
                        <option value="3"<?= (int) $u->level === 3 ? ' selected' : '' ?>>3</option>
                      </select>
                    </div>
                    <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                  </form>
                  <form onsubmit="event.preventDefault();" class="mt-3">
                    <div class="input-group input-group-sm mb-1">
                      <label for="u_status_<?= $u->id ?>" class="input-group-text">Status</label>
                      <select id="u_status_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_status">
                        <option value="-1"<?= (int) $u->status === -1 ? ' selected' : '' ?>>Banned</option>
                        <option value="0"<?= (int) $u->status === 0 ? ' selected' : '' ?>>Inactive</option>
                        <option value="1"<?= (int) $u->status === 1 ? ' selected' : '' ?>>Active</option>
                      </select>
                    </div>
                    <button class="btn btn-block btn-sm btn-info w-100">UPDATE</button>
                  </form>
                </td>
                <td>
                  <?php if ((int) $__user__['update_permission'] == 1): ?>
                  <div>
                    <button class="btn btn-block btn-sm btn-info w-100">UPDATE PASSWORD</button>
                  </div>
                  <?php endif; ?>
                  <?php if ((int) $__user__['delete_permission'] == 1): ?>
                  <div class="mt-2">
                    <button class="btn btn-block btn-sm btn-danger w-100" onclick="deleteUser('<?= $u->id ?>', '<?= $u->username ?>')">DELETE</button>
                  </div>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
