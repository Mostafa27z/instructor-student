<?php
    include 'shared/head.php';
    include 'shared/nav.php';
    include '../conn.php';
    $fail = false;
    $name = '';
    $link = '';
    $ques = '';
    
    if(isset($_GET['up'])){

      $id = $_GET['up']; 
      
      $sql = "SELECT * FROM `tasks` where id =$id ";
      $task = mysqli_fetch_assoc( mysqli_query($conn , $sql));
      $name = $task['name'];
      $link =$task['link'];
      $ques =$task['ques'];
    
      
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $link = $_POST['link'];
        $ques = $_POST['ques'];
        if(empty($name) or empty($link) or empty($ques) ){
          $fail = "Please fill all input fields";
        }
        else{

            $update = "UPDATE `tasks` SET name = '$name'  , link='$link'   , ques='$ques' where id =$id ";
            mysqli_query($conn , $update);
        
            echo "<script>
            location.replace('index.php');
            </script>";
        
            echo "<script>location.replace('index.php?');</script>";
        }
      
    }}
    else{
      echo "<script>location.replace('index.php?');</script>";
    }
   
   
    
?>
<form class="col-md-6 col-sm-8 col-10 m-auto upload form" method='post'>
  <div class="mb-3">
    <label  class="form-label">Task Name</label>
    <input type="text" class="form-control" name='name' value="<?=$name?>">
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Link</label>
    <input type="text" class="form-control" name='link' value="<?=$link?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Question</label>
    <input type="text" class="form-control" name='ques' value="<?=$ques?>" >
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