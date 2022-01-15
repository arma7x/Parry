              <?php foreach($users['result'] as $u): ?>
              <tr>
                <th class="text-start">
                  #<?= $u->id ?>
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
                  <form onsubmit="event.preventDefault();">
                    <div class="input-group input-group-sm mb-1">
                      <span for="u_level_<?= $u->id ?>" class="input-group-text bg-dark text-white">Level</span>
                      <select id="u_level_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Level" aria-describedby="u_level"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                        <option value="0"<?= (int) $u->level === 0 ? ' selected' : '' ?>>0</option>
                        <option value="1"<?= (int) $u->level === 1 ? ' selected' : '' ?>>1</option>
                        <option value="2"<?= (int) $u->level === 2 ? ' selected' : '' ?>>2</option>
                        <option value="3"<?= (int) $u->level === 3 ? ' selected' : '' ?>>3</option>
                      </select>
                    </div>
                    <?php if ((int) $__user__['update_permission'] == 1): ?>
                    <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'level', 'u_level_<?= $u->id ?>');">UPDATE</button>
                    <?php endif; ?>
                  </form>
                  <form onsubmit="event.preventDefault();" class="mt-3">
                    <div class="input-group input-group-sm mb-1">
                      <label for="u_status_<?= $u->id ?>" class="input-group-text bg-dark text-white">Status</label>
                      <select id="u_status_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Status" aria-describedby="u_status"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                        <option value="-1"<?= (int) $u->status === -1 ? ' selected' : '' ?>>Banned</option>
                        <option value="0"<?= (int) $u->status === 0 ? ' selected' : '' ?>>Inactive</option>
                        <option value="1"<?= (int) $u->status === 1 ? ' selected' : '' ?>>Active</option>
                      </select>
                    </div>
                    <?php if ((int) $__user__['update_permission'] == 1): ?>
                    <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'status', 'u_status_<?= $u->id ?>');">UPDATE</button>
                    <?php endif; ?>
                  </form>
                </td>
                <td class="text-start">
                  <div class="container row p-0 m-0">
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_r_perm_<?= $u->id ?>" class="input-group-text bg-dark text-white">Read&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <select id="u_r_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Read Permission" aria-describedby="u_r_perm"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                          <option value="0"<?= (int) $u->read_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->read_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <?php if ((int) $__user__['update_permission'] == 1): ?>
                      <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'read_permission', 'u_r_perm_<?= $u->id ?>');">UPDATE</button>
                      <?php endif; ?>
                    </form>
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0 ms-1">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_c_perm_<?= $u->id ?>" class="input-group-text bg-dark text-white">Create</label>
                        <select id="u_c_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Create Permission" aria-describedby="u_c_perm"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                          <option value="0"<?= (int) $u->create_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->create_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <?php if ((int) $__user__['update_permission'] == 1): ?>
                      <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'create_permission', 'u_c_perm_<?= $u->id ?>');">UPDATE</button>
                      <?php endif; ?>
                    </form>
                  </div>
                  <div class="container row p-0 m-0 my-3">
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_u_perm_<?= $u->id ?>" class="input-group-text bg-dark text-white">Update</label>
                        <select id="u_u_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Update Permission" aria-describedby="u_u_perm"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                          <option value="0"<?= (int) $u->update_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->update_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <?php if ((int) $__user__['update_permission'] == 1): ?>
                      <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'update_permission', 'u_u_perm_<?= $u->id ?>');">UPDATE</button>
                      <?php endif; ?>
                    </form>
                    <form onsubmit="event.preventDefault();" class="col p-0 m-0 ms-1">
                      <div class="input-group input-group-sm mb-1">
                        <label for="u_d_perm_<?= $u->id ?>" class="input-group-text bg-dark text-white">Delete</label>
                        <select id="u_d_perm_<?= $u->id ?>" class="form-select form-select-sm" aria-label="Delete Permission" aria-describedby="u_d_perm"<?= (int) $__user__['update_permission'] == 1 ? '' : ' disabled'; ?>>
                          <option value="0"<?= (int) $u->delete_permission === 0 ? ' selected' : '' ?>>No</option>
                          <option value="1"<?= (int) $u->delete_permission === 1 ? ' selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                      <?php if ((int) $__user__['update_permission'] == 1): ?>
                      <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'delete_permission', 'u_d_perm_<?= $u->id ?>');">UPDATE</button>
                      <?php endif; ?>
                    </form>
                  </div>
                </td>
                <td>
                  <?php if ((int) $__user__['update_permission'] == 1): ?>
                  <div class="input-group-sm mb-1">
                    <input id="u_password_<?= $u->id ?>" type="text" class="form-control" placeholder="New password" aria-label="Password">
                  </div>
                  <button class="btn btn-block btn-sm btn-info w-100" onclick="updateUser('<?= $u->id ?>', '<?= $u->username ?>', 'password', 'u_password_<?= $u->id ?>');">UPDATE</button>
                  <?php endif; ?>
                  <?php if ((int) $__user__['delete_permission'] == 1): ?>
                  <div class="mt-2">
                    <button class="btn btn-block btn-sm btn-danger w-100" onclick="deleteUser('<?= $u->id ?>', '<?= $u->username ?>')">DELETE</button>
                  </div>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
