<?php
include 'shared/head.php';
include 'shared/nav.php';
include '../conn.php';
$id = $_SESSION['id'];
$sql = "SELECT * from `tasks` where stdID=$id  ";
$data = mysqli_query($conn, $sql);
if(isset($_GET['del'])){
    $did = $_GET['del'];
    $del = "DELETE FROM `tasks` where id = $did";
    mysqli_query($conn , $del);
   echo "<script>location.replace('index.php?');</script>";
}
?>
<table class="table ">
  <thead class="table-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Task Name</th>
      
      <th scope="col">Link</th>
      <th scope="col">Question</th>
      <th scope="col" >Instructor Comment</th>
      <th scope="col" colspan='2'  class='text-center'>Action </th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $d):
    ?>
    <tr>
      <th scope="row"> <?= $d['id'] ?></th>
      <td><?= $d['name'] ?></td>
      
      <td> <a href="<?= $d['link'] ?>">Link</a></td>
      <td><?= $d['ques'] ?></td>
      <td><?= $d['comment'] ?></td>
      <td class='text-center'><a class="btn btn-outline-primary" href='up.php?up="<?= $d['id'] ?>"' >Update </a></td>
      <td class='text-center'> <a class="btn btn-danger" href='index.php?del="<?= $d['id'] ?>"'>Delete </a></td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
<?php
include 'shared/bot.php';
?>