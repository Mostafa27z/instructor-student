<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $fail = false;
    $name = '';
    $email = '';
    $pass = '';
    $ins ='';
    if(isset($_GET['up'])){

      $id = $_GET['up']; 
      
      $sql = "SELECT * FROM `students` where id =$id ";
      $ins = mysqli_fetch_assoc( mysqli_query($conn , $sql));
      $name = $ins['name'];
      $pass =$ins['pass'];
      $in =$ins['insID'];
      $email = $ins['email'];
      if(isset($_POST['update'])){
        $name = $_POST['name'];
        $pass =$_POST['pass'];
        $email = $_POST['email'];
        $in = $_POST['ins'];
        $em = "SELECT * FROM students where email = '$email' ";
      $em = mysqli_fetch_assoc(mysqli_query($conn , $em));
        if(empty($name) or empty($email) or empty($pass) or empty($in)){
          $fail = "Please fill all input fields";
        }
        else if($em and $em['id'] !=  $id){
          $fail = "This email already has an account";
      }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $fail = "Invalid email format";
        }
        else if(strlen($pass) < 8){
          $fail = "Password should be at least 8 chararcters";
        } else{
        
        $update = "UPDATE `students` SET name = '$name'  , email='$email'   , insID=$in, pass = '$pass' where id =$id ";
        mysqli_query($conn , $update);
        echo "<script>location.replace('student.php?');</script>";
      }
    
      }
    }
    else{
      echo "<script>location.replace('index.php?');</script>";
    }
   
    $inst = "SELECT * from `instructors`";
    $inst = mysqli_query($conn , $inst);
    
?>
<form class="col-md-6 col-sm-8 col-10 m-auto upload" method='post'>
  <div class="mb-3">
    <label  class="form-label">Student Name</label>
    <input type="text" class="form-control" name='name' value="<?=$name?>">
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="text" class="form-control" name='email' value="<?=$email?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Instructor</label>
    <select name="ins" id="" value=''>
      <?php
        foreach ($inst as $i):
      ?>
      <option value="<?=$i['id']?>"><?=$i['name']?></option>
      <?php
    endforeach;
  ?>
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