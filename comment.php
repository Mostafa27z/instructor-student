<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $fail = false;
    
    if(isset($_GET['com'])){

      $id = $_GET['com']; 
      
      $sql = "SELECT * FROM `tasks` where id =$id ";
      $com = mysqli_fetch_assoc( mysqli_query($conn , $sql));
      $data = $com['comment'];
      if(isset($_POST['send'])){
        $comment = $_POST['com'];
        $update = "UPDATE `tasks` SET comment = '$comment'   where id =$id ";
        mysqli_query($conn , $update);
        echo "<script>location.replace('index.php?');</script>";
    
      }
    }
    else{
      echo "<script>location.replace('index.php?');</script>";
    }
?>
<form class='col-md-6 col-sm-8 col-10 logForm'  method='post'>
  
  <div class="mb-3">
    <label  class="form-label">Your Comment</label>
    <input type="text" class="form-control" name='com' value="<?=$data?>"  aria-describedby="emailHelp">
    
  </div>
 
  
  <?php
    if($fail):
  ?>
  <div class="mb-3 alert alert-danger">
    This Field Cannot be empty
  </div>
  <?php
    endif;
  ?>
  <button type="submit" class="btn btn-primary" name='send'>Send</button>
</form>
<?php
    include 'shared/bot.php';
    
?> 