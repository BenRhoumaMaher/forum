<?php require'../includes/header.php';  ?>
<?php require'../config/config.php';  ?>

<?php 
if(!isset($_SESSION['username'])) {
    header("location: ".PATH."");
  }

if(isset($_POST['submit'])){
    if(empty($_POST['title']) || empty($_POST['category']) || empty($_POST['body'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $body = $_POST['body'];
        $user_name = $_SESSION['name'];
        $user_image = $_SESSION['user_image'];


        $sql = "INSERT INTO topics(title,category,body,user_name, user_image)
        VALUES(:title,:category,:body,:user_name, :user_image)";
		
        $smt = $dba->prepare($sql);
		$smt->bindParam(':title',$title);
		$smt->bindParam(':category',$category);
		$smt->bindParam(':body',$body);
		$smt->bindParam(':user_name',$user_name);
		$smt->bindParam(':user_image',$user_image);

		$smt->execute();

		if($smt){
			header("location: ".PATH."");
		}
    }
}
        $cat = "SELECT * from categories";
        $smtc = $dba->prepare($cat);
        $smtc->execute();
        $allcat = $smtc->fetchAll(PDO::FETCH_OBJ);
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
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Topic Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <?php foreach($allcat as $cat) : ?>
                                <option value="<?php echo $cat->name ; ?>"><?php echo $cat->name ; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topic Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
                            <script>
                            CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require'../includes/footer.php'; ?>