      <div class="container h-100">
        <h1 class="mt-2">Internal Users</h1>
        <div class="row">
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
      </div>
