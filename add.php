<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    if($_SESSION['stat'] == 2){
      echo "<script>location.replace('index.php?');</script>";
    }
    $fail = false;
    $name = '';
      $email = '';
      $pass = '';
      $track ='';
    if(isset($_POST['add'])){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $track = $_POST['track'];
      $stat = $_POST['stat'];
      $em = "SELECT * FROM instructors where email = '$email' ";
      $em = mysqli_fetch_assoc(mysqli_query($conn , $em));
      if(empty($name) or empty($email) or empty($pass) or empty($track)){
        $fail = "Please fill all input fields";
      }
      else if($em){
        $fail = "This email already have an account";
      }
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fail = "Invalid email format";
      }
      else if(strlen($pass) < 8){
        $fail = "Password should be at least 8 chararcters";
      }
      else{
        $sql="INSERT INTO instructors (name , email , track , pass , stat) VALUES('$name' ,'$email' ,'$track' ,'$pass' , $stat)";
        mysqli_query($conn, $sql);
        echo "<script>
        location.replace('tasks.php');
        </script>";
      }
    }
?>
<form class="col-md-6 col-sm-8 col-10 m-auto upload" method='post'>
  <div class="mb-3">
    <label  class="form-label">Instructor Name</label>
    <input type="text" class="form-control" name='name' value="<?=$name?>">
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="text" class="form-control" name='email' value="<?=$email?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Track</label>
    <input type="text" class="form-control" name='track' value="<?=$track?>" >
  </div>
  <div class="mb-3">
    <label  class="form-label"> Status</label>
    <select name="stat" id="">
      <option value="1">Admin</option>
      <option value="2">Instructor</option>
    </select>
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" class="form-control" name='pass' value="<?=$pass?>" >
  </div>
  <?php
    if($fail):
  ?>
  <div class="mb-3 alert alert-danger">
    <?=$fail?>
  </div>
  <?php
    endif;
  ?>
  <button type="submit" class="btn btn-primary" name='add'>Add</button>
</form>
<?php
    include 'shared/bot.php';
    
?> 