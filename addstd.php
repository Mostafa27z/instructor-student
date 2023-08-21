<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include 'conn.php';
    $fail = false;
    $name = '';
      $email = '';
      $pass = '';
      $track ='';
      $inst = "SELECT * from `instructors`";
      $inst = mysqli_query($conn , $inst);
    if(isset($_POST['add'])){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $ins = $_POST['ins'];
      $em = "SELECT * FROM students where email = '$email' ";
      $em = mysqli_fetch_assoc(mysqli_query($conn , $em));
      if(empty($name) or empty($email) or empty($pass) or empty($ins)){
        $fail = "Please fill all input fields";
      }
      else if($em) {
        $fail = "This email already have an account";
      }
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fail = "Invalid email format";
      }
      else if(strlen($pass) < 8){
        $fail = "Password should be at least 8 chararcters";
      }
      else{
        $sql="INSERT INTO students (name , email , insID , pass) VALUES('$name' ,'$email' ,'$ins' ,'$pass')";
        mysqli_query($conn, $sql);
        echo "<script>
        location.replace('student.php');
        </script>";
      }
    }
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
    <select name="ins" id="">
      <?php
        foreach ($inst as $i):
      ?>
      <option value="<?=$i['id']?>"><?=$i['name']?></option>
      <?php
    endforeach;
  ?>
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