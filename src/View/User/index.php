<!DOCTYPE html>
<div id="list">
  ユーザ一覧<br>
<?php foreach ($this->users as $user) : ?>
  <?=$user?><br>
<?php endforeach; ?>
</div>
<div id="menu">
  <a href="/user/registration">登録</a>
</div>
