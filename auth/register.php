<?php require'../includes/header.php';  ?>
<?php require'../config/config.php';  ?>

<?php 
if(isset($_SESSION['username'])) {
    header("location: ".PATH."");
  }

if(isset($_POST['register'])){
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) 
    || empty($_POST['password']) || empty($_POST['about'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $about = $_POST['about'];
        $avatar = $_FILES['avatar']['name'];
		$temp = $_FILES['avatar']['tmp_name'];

        $dir = "../img/" .basename($avatar);


        $sql = "INSERT INTO users(name,email,username,password,about,avatar)
        VALUES(:name,:email,:username,:password,:about,:avatar)";
		
        $smt = $dba->prepare($sql);
		$smt->bindParam(':name',$name);
		$smt->bindParam(':email',$email);
		$smt->bindParam(':username',$username);
		$smt->bindParam(':password',$password);
		$smt->bindParam(':about',$about);
		$smt->bindParam(':avatar',$avatar);

		$smt->execute();

		if($smt){
			move_uploaded_file($temp,$dir);
			header("location: login.php");
		}
    }
}


?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Register</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label>Name*</label> <input type="text" class="form-control" name="name"
                                placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label>Email Address*</label> <input type="email" class="form-control" name="email"
                                placeholder="Enter Your Email Address">
                        </div>
                        <div class="form-group">
                            <label>Choose Username*</label> <input type="text" class="form-control" name="username"
                                placeholder="Create A Username">
                        </div>
                        <div class="form-group">
                            <label>Password*</label> <input type="password" class="form-control" name="password"
                                placeholder="Enter A Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password*</label> <input type="password" class="form-control"
                                name="password2" placeholder="Enter Password Again">
                        </div>
                        <div class="form-group">
                            <label>Upload Avatar</label>
                            <input type="file" name="avatar">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label>About Me</label>
                            <textarea id="about" rows="6" cols="80" class="form-control" name="about"
                                placeholder="Tell us about yourself (Optional)"></textarea>
                        </div>
                        <input name="register" type="submit" class="color btn btn-default" value="Register" />
                    </form>
                </div>
            </div>
        </div>
        <?php require'../includes/footer.php';  ?>