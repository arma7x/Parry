              <?php foreach($users['result'] as $u): ?>
              <tr>
                <th scope="row"><?= $u->id ?></th>
                <td class="text-start">
                  <div>
                    <div style="font-size:90%;font-weight:bold;">Username</div>
                    <div><?= $u->username ?></div>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Email</div>
                    <div><?= $u->email ?></div>
                  </div>
                </td>
                <td class="text-start">
                  <div>
                    <div style="font-size:90%;font-weight:bold;">Level</div>
                    <?= $u->level ?>
                  </div>
                  <div class="mt-2">
                    <div style="font-size:90%;font-weight:bold;">Status</div>
                    <?= $u->status ?>
                  </div>
                </td>
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
                <?php if ((int) $__user__['level'] <= 0): ?>
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
                <?php endif; ?>
              </tr>
              <?php endforeach; ?>
