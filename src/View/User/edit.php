<!DOCTYPE html>
<?php if (isset($this->error)) : ?>
<div id="error">
  <?php echo $this->error; ?>
</div>
<?php endif; ?>
<form method="post" action="/user/update/">
  <ul>
    <li>
      <label>
        名前：<input type="text" name="name" value="<?= $this->my_user->name ?>" required>
      </label>
    </li>
    <li>
      <label>
        メールアドレス：<input type="text" name="mail" value="<?= $this->my_user->mail ?>" required>
      </label>
    </li>
    <li>
      <label>
        パスワード*：<input type="text" name="pass">
      </label>
    </li>
  </ul>
  <input type="hidden" value="<?= $this->my_user->id ?>">
  <input type="submit" value="更新する">
</form>