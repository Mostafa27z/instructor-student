<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * from `tasks` where insid=$id  ";
    $data = mysqli_query($conn, $sql);
    
?>
<table class="table ">
  <thead class="table-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Task Name</th>
      <th scope="col">std name</th>
      <th scope="col">Link</th>
      <th scope="col">Question</th>
      <th scope="col" colspan='2' class='text-center'>Comment</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $d):
    ?>
    <tr>
      <th scope="row"> <?= $d['id'] ?></th>
      <td><?= $d['name'] ?></td>
      <td><?= $d['stdname'] ?></td>
      <td> <a href="<?= $d['link'] ?>">Link</a></td>
      <td><?= $d['ques'] ?></td>
      <td><?= $d['comment'] ?></td>
      <td><a class="btn btn-outline-primary" href='comment.php?com="<?= $d['id'] ?>"'>Add comment</a></td>
      
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
<?php
    include 'shared/bot.php';
    
?> 