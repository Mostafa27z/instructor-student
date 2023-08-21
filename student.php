

<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $ins=$_SESSION['id'];
    $sql = "SELECT * from `students` where insID = $ins";
    $data = mysqli_query($conn, $sql);
    if(isset($_GET['del'])){
      $did = $_GET['del'];
      $del = "DELETE FROM `students` where id = $did";
      mysqli_query($conn , $del);
     echo "<script>location.replace('student.php?');</script>";
  }
 
?>
<table class="table ">
  <thead class="table-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col"> Name</th>
      <th scope="col">Email</th>
      <th scope="col">Intructor </th>
      <th scope="col" colspan='2' class='text-center'> Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $d):
      $ide = $d['insID'];
      $nm = "SELECT * FROM instructors where id=$ide " ;
      $nm = mysqli_query($conn , $nm);
      $nm= mysqli_fetch_assoc($nm);
    ?>
    <tr>
      <th scope="row"> <?= $ide  ?></th>
      <td><?= $d['name'] ?></td>
      <td><?= $d['email'] ?></td>
      <td><?= $nm['name'] ?>
    
    </td>
      <td class='text-center'><a href='upstd.php?up=<?= $d['id'] ?>' class='btn btn-info'>Update</a></td>
      <td class='text-center'><a href='?del="<?= $d['id'] ?>"' class='btn btn-danger'>Delete</a></td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
<?php
    include 'shared/bot.php';
    
?> 