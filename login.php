<?php
    include 'shared/head.php';
    include 'conn.php';
    $fail=false;
    if(isset($_POST['out'])){
      session_start();
      session_unset();
      session_destroy();
    }
    if(isset($_POST['log'])){
        $pass= $_POST['pass'];
        $email= $_POST['email'];
        $sql = "SELECT * FROM `instructors` where email='$email' and pass='$pass'";
        $ins = mysqli_query($conn , $sql);
        $ins = mysqli_fetch_assoc($ins);
        if($ins){
            session_start();
            $_SESSION['id'] = $ins['id'];
            $_SESSION['name'] = $ins['name'];
            $_SESSION['email'] = $ins['email'];
            $_SESSION['pass'] = $ins['pass'];
            $_SESSION['track'] = $ins['track'];
            $_SESSION['stat'] = $ins['stat'];
            echo "<script>
            location.replace('index.php');
            </script>";
        }
        else{
            $fail = true;
        }
    }
?>
<form class='col-md-6 col-sm-8 col-10 col-sm-8 logForm'  method='post'>
  
  <div class="mb-3">
    <label  class="form-label">Email address</label>
    <input type="email" class="form-control" name='email'  aria-describedby="emailHelp">
    
  </div>
 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control"  name='pass'id="exampleInputPassword1">
  </div>
  <?php
    if($fail):
  ?>
  <div class="mb-3 alert alert-danger">
    Wrong email or password
  </div>
  <?php
    endif;
  ?>
  <button type="submit" class="btn btn-primary" name='log'>Log In</button>
</form>
<?php
    include 'shared/bot.php';
    
?> 