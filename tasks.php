

<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $sql = "SELECT * from `instructors`";
    $data = mysqli_query($conn, $sql);
    if(isset($_GET['del'])){
      $did = $_GET['del'];
      $del = "DELETE FROM `instructors` where id = $did";
      mysqli_query($conn , $del);
     echo "<script>location.replace('tasks.php?');</script>";
  }
  if($_SESSION['stat'] == 2){
    echo "<script>location.replace('index.php?');</script>";
  }
?>
<table class="table ">
  <thead class="table-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col"> Name</th>
      <th scope="col">Email</th>
      <th scope="col">Track</th>
      <th scope="col" colspan='2' class='text-center'> Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $d):
    ?>
    <tr>
      <th scope="row"> <?= $d['id'] ?></th>
      <td><?= $d['name'] ?></td>
      <td><?= $d['email'] ?></td>
      <td><?= $d['track'] ?></td>
      <td><a href='update.php?up=<?= $d['id'] ?>' class='btn btn-info'>Update</a></td>
      <td><a href='tasks.php?del="<?= $d['id'] ?>"' class='btn btn-danger'>Delete</a></td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
<?php
    include 'shared/bot.php';
    
?> 