<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>
<?php 

 if(isset($_GET['id'])){
	  
	 $id = $_GET['id'];

	 $sql = "SELECT * FROM replies WHERE id = '$id'";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $reply = $smt->fetch(PDO::FETCH_OBJ);

     if($reply->user_id !== $_SESSION['user_id']){
        header("location: ".PATH."");
     } else {
		$sql = "DELETE FROM replies WHERE id = '$id'";

		$smt = $dba->prepare($sql);
		$smt->execute();
   
		if($smt) {
		   header("location: ".PATH."");
		}
	 }

 }
?>