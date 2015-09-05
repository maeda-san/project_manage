<!DOCTYPE html>
<div id="list">
  <ul>
    <?php foreach ($this->companies as $company): ?>
      <li>
        <?= $company->name ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>