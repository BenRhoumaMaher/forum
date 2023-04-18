<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"; ?>
<?php 

if(!isset($_SESSION['adminname'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
    }  

    if(isset($_POST['submit'])){
      if(empty($_POST['name'])){
          echo "<script>alert('one or more inputs are empty');</script>";
      } else {
          $category = $_POST['name'];
  
  
          $sql = "INSERT INTO categories(name)
          VALUES(:name)";
      
          $smt = $dba->prepare($sql);
          $smt->bindParam(':name',$category);
  
          $smt->execute();
  
          if($smt){
            header("location: ".ADMINURL."");
          }
      }
  }

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Categories</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                </form>

            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>