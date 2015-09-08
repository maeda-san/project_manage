<!DOCTYPE html>
<div id="table">
  <table>
    <tr>
      <th>プロジェクトコード</th>
      <th>顧客名</th>
      <th>案件名</th>
    </tr>
    <?php foreach ($this->projects as $project) : ?>
      <tr>
        <td><?= $project->code ?></td>
        <td><?= $project->getCompanyName() ?></td>
        <td><?= $project->name ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<a href="/project/registration">登録する</a>