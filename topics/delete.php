<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>
<?php 

 if(isset($_GET['id'])){
	  
	 $id = $_GET['id'];

	 $sql = "SELECT * FROM topics WHERE id = '$id'";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $topic = $smt->fetch(PDO::FETCH_OBJ);

     if($topic->user_name !== $_SESSION['username']){
        header("location: ".PATH."");
     } else {
		$sql = "DELETE FROM topics WHERE id = '$id'";

		$smt = $dba->prepare($sql);
		$smt->execute();
   
		if($smt) {
		   header("location: ".PATH."");
		}
	 }

 }
?>