<!DOCTYPE html>
<?php if (isset($this->error)) : ?>
<div id="error">
  <?php echo $this->error; ?>
</div>
<?php endif; ?>
<form method="post" action="/project/add/">
  <ul>
    <li>
      <label>
        案件名：
        <input type="text" name="name" required>
      </label>
    </li>
    <li>
      <label>
        プロジェクトコード：
        <input type="text" name="code" required>
      </label>
    </li>
    <li>
      <label>
        ステータス：
        <select name="status" required>
          <?php foreach (Project::status_relation as $value => $status) : ?>
            <option value="<?= $value ?>"><?= $status ?></option>
          <?php endforeach; ?>
        </select>
      </label>
    </li>
    <li>
      <label>
        顧客：
        <select name="company" required>
          <?php foreach ($this->companies as $company) : ?>
              <option value="<?= $company->id ?>"><?= $company->name ?></option>
          <?php endforeach; ?>
        </select>
      </label>
    </li>
  </ul>
  <input type="submit" value="登録する">
</form>