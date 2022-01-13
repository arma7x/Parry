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
              </tr>
              <?php endforeach; ?>
