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
    if(isset($_GET['up'])){

      $id = $_GET['up']; 
      
      $sql = "SELECT * FROM `instructors` where id =$id ";
      $ins = mysqli_fetch_assoc( mysqli_query($conn , $sql));
      $name = $ins['name'];
      $pass =$ins['pass'];
      $track =$ins['track'];
      $email = $ins['email'];
      if(isset($_POST['update'])){

        $name = $_POST['name'];
        $pass =$_POST['pass'];
        $email = $_POST['email'];
        $track = $_POST['track'];
        $em = "SELECT * FROM instructors where email = '$email' ";
      $em = mysqli_fetch_assoc(mysqli_query($conn , $em));
      $d = $em['id'];
        if(empty($name) or empty($email) or empty($pass) or empty($track)){
          $fail = "Please fill all input fields";
        }
        else if($em  and $em['id'] !=  $id){
          
          
          $fail = "This email already has an account";
      }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $fail = "Invalid email format";
        }
        else if(strlen($pass) < 8){
          $fail = "Password should be at least 8 chararcters";
        } else{
       
        $update = "UPDATE `instructors` SET name = '$name'  , email='$email'   , track='$track', pass = '$pass' where id =$id ";
        mysqli_query($conn , $update);
        echo "<script>location.replace('tasks.php?');</script>";
        
        if($id == $_SESSION['id']){
         
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
           
            $_SESSION['track'] = $_POST['track'];
            
        }
        }
      }
    }
    else{
      echo "<script>location.replace('index.php?');</script>";
    }
   
   
    
?>
<form class="col-md-6 col-sm-8 col-10-6 m-auto upload" method='post'>
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
  <button type="submit" class="btn btn-primary" name='update'>Update</button>
</form>
<?php
    include 'shared/bot.php';
    
?> 