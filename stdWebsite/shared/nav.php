<nav class="navbar navbar-expand-lg bg-dark ">
  <?php
session_start();
  if(!isset($_SESSION['name'])){
    echo "<script>location.replace('login.php?');</script>";
  }
  ?>
  <div class="container-fluid text-light">
    <a class="navbar-brand text-light" href="index.php">Welcome <?=$_SESSION['name']?> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php">| Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="sub.php">| Upload Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="update.php">| Update Profile</a>
        </li>
       
       
        
      </ul>
      
      <form class="d-flex"  method="post" role="search" action="login.php">
        <button class="btn btn-outline-danger" type="submit" name='out'>log out</button>
      </form>
      
    </div>
  </div>
</nav>