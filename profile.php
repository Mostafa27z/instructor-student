<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $fail = false;
    $name = '';
    $link = '';
    $ques = '';
    
    

      $id = $_SESSION['id']; 
      
      $sql = "SELECT * FROM `instructors` where id =$id ";
      $inst = mysqli_fetch_assoc( mysqli_query($conn , $sql));
      $name = $inst['name'];
      $email =$inst['email'];
      $pass =$inst['pass'];
    
      
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $confpass = $_POST['confpass'];
        $em = "SELECT * FROM instructors where email = '$email' ";
      $em = mysqli_fetch_assoc(mysqli_query($conn , $em));
        if(empty($name) or empty($email) or empty($newpass) or empty($confpass) or empty($oldpass) ){
          $fail = "Please fill all input fields";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $fail = "Invalid email format";
        }
        else if($em and $em['id'] !=  $_SESSION['id']){
            $fail = "This email already has an account";
        }
        else if($oldpass != $pass){
            $fail = "Wrong Password";
        }
        else if($confpass != $newpass){
            $fail = "Passwords Doesn't Match";
        }
        else{

            $update = "UPDATE `instructors` SET name = '$name'  , email='$email'   , pass='$pass' where id =$id ";
            mysqli_query($conn , $update);
            $sql = "SELECT * FROM `instructors` where id=$id";
        $ins = mysqli_query($conn , $sql);
        $ins = mysqli_fetch_assoc($ins);
        
           
            
            $_SESSION['name'] = $ins['name'];
            $_SESSION['email'] = $ins['email'];
            $_SESSION['pass'] = $ins['pass'];
            
            echo "<script>location.replace('index.php?');</script>";
        }
      
    }
   
   
    
?>
<form class="col-md-6 col-sm-8 col-10  m-auto upload " method='post'>
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" class="form-control" name='name' value="<?=$name?>">
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="text" class="form-control" name='email' value="<?=$email?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Old Password</label>
    <input type="password" class="form-control" name='oldpass' value="" >
  </div>
  <div class="mb-3">
    <label  class="form-label">New Password</label>
    <input type="password" class="form-control" name='newpass' value="" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name='confpass' value="" >
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