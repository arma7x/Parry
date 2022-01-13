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
