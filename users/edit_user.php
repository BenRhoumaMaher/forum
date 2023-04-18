<?php require'../includes/header.php';  ?>
<?php require'../config/config.php';  ?>

<?php 
if(!isset($_SESSION['username'])) {
    header("location: ".PATH."");
  }

if(isset($_GET['id'])){
     $id = $_GET['id'];
	 $sql = "SELECT * FROM users WHERE id = '$id'";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $users = $smt->fetch(PDO::FETCH_OBJ);

     if($users->id !== $_SESSION['user_id']){
        header("location: ".PATH."");
     }

}  

if(isset($_POST['submit'])){
    if(empty($_POST['email']) || empty($_POST['about'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $about = $_POST['about'];


        $sql = "UPDATE users SET about= :about,email= :email WHERE id = $id";
		
        $smt = $dba->prepare($sql);
		$smt->bindParam(':email',$email);
		$smt->bindParam(':about',$about);

		$smt->execute();

		if($smt){
			header("location: ".PATH."");
		}
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Create A Topic</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="post" action="edit_user.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="<?php echo $users->email; ?>" class="form-control" name="email"
                                placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>About</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="about">
                            <?php echo $users->about; ?>
                            </textarea>
                            <script>
                            CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require'../includes/footer.php';  ?>