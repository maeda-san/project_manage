<!DOCTYPE html>
<?php if (isset($this->error)) : ?>
<div id="error">
    <?php echo $this->error; ?>
</div>
<?php endif; ?>
<form method="post" action="/company/add/">
    <ul>
        <li>
            <label>
                顧客名：<input type="text" name="name" required>
            </label>
        </li>
    </ul>
    <input type="submit" value="登録する">
</form>