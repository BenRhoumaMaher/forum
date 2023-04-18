<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"; ?>
<?php 
if(!isset($_SESSION['adminname'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
  }

  if(isset($_GET['id'])){
    $id = $_GET['id'];
  $sql = "SELECT * FROM categories WHERE id = '$id'";

  $smt = $dba->prepare($sql);
  $smt->execute();
  $category = $smt->fetch(PDO::FETCH_OBJ);

} 

  if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];


        $sql = "UPDATE categories SET name = :name WHERE id = $id";
		
        $smt = $dba->prepare($sql);
		$smt->bindParam(':name',$name);

		$smt->execute();

		if($smt){
			header("location: show-categories.php");
		}
    }
}
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" id="form2Example1" class="form-control"
                            value="<?php echo $category->name; ?>" />

                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                </form>

            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>