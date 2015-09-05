<!DOCTYPE html>
<?php if (isset($this->error)) : ?>
<div id="error">
  <?php echo $this->error; ?>
</div>
<?php endif; ?>
<form method="post" action="/user/add/">
  <ul>
    <li>
      <label>
        名前：<input type="text" name="name" required>
      </label>
    </li>
    <li>
      <label>
        メールアドレス：<input type="text" name="mail" required>
      </label>
    </li>
    <li>
      <label>
        パスワード：<input type="text" name="pass" required>
      </label>
    </li>
  </ul>
  <input type="submit" value="登録する">
</form>