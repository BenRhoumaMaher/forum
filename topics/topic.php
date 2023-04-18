<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>
<?php 

 if(isset($_GET['id'])){
	  
	 $id = $_GET['id'];
	 $sql = "SELECT * FROM topics WHERE id = '$id'";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $singletopic = $smt->fetch(PDO::FETCH_OBJ);

	$topicCount = "SELECT COUNT(*) AS count_topics FROM topics  WHERE user_name = '$singletopic->user_name'";
	$smtt = $dba->prepare($topicCount);
	$smtt->execute();
	$count = $smtt->fetch(PDO::FETCH_OBJ);

	$reply = "SELECT * FROM replies WHERE topic_id = '$id'";

	$rep = $dba->prepare($reply);
	$rep->execute();
	$allreplies = $rep->fetchAll(PDO::FETCH_OBJ);

 } else {
    header("location: ".PATH."/404.php");
 }

 if(isset($_POST['submit'])){
    if(empty($_POST['reply'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $reply = $_POST['reply'];
        $user_id = $_SESSION['user_id'];
        $user_image = $_SESSION['user_image'];
        $topic_id = $id;
        $user_name = $_SESSION['username'];


        $sql = "INSERT INTO replies(reply,user_id,user_image,topic_id,user_name)
        VALUES(:reply,:user_id,:user_image,:topic_id,:user_name)";
		
        $smt = $dba->prepare($sql);
		$smt->bindParam(':reply',$reply);
		$smt->bindParam(':user_id',$user_id);
		$smt->bindParam(':user_image',$user_image);
		$smt->bindParam(':topic_id',$topic_id);
		$smt->bindParam(':user_name',$user_name);

		$smt->execute();

		if($smt){
			header("location: ".PATH."/topics/topic.php?id=".$id."");
		}
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><?php echo $singletopic->title; ?></h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left"
                                            src="../img/<?php echo $singletopic->user_image; ?>" />
                                        <ul>
                                            <li><strong><?php echo $singletopic->user_name; ?></strong></li>
                                            <li><?php echo $count->count_topics; ?> Posts</li>
                                            <li><a
                                                    href="<?php echo PATH ; ?>/users/profile.php?name=<?php echo $singletopic->user_name; ?>">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo $singletopic->body; ?></p>
                                    </div>
                                    <?php if(isset($_SESSION['username'])) : ?>
                                    <?php if($singletopic->user_name == $_SESSION['username']) : ?>
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $singletopic->id; ?>"
                                        role="button">Delete</a>
                                    <a class="btn btn-warning" href="update.php?id=<?php echo $singletopic->id; ?>"
                                        role="button">Update</a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($allreplies as $reply) : ?>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="../img/<?php echo $reply->user_image; ?>" />
                                        <ul>
                                            <li><strong><?php echo $reply->user_name; ?></strong></li>
                                            <li><a
                                                    href="../users/profile.php?name=<?php echo $singletopic->user_name; ?>">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo $reply->reply; ?></p>
                                    </div>
                                    <?php if(isset($_SESSION['username'])) : ?>
                                    <?php if($reply->user_id == $_SESSION['user_id']) : ?>
                                    <a class="btn btn-danger" href="../replies/delete.php?id=<?php echo $reply->id; ?>"
                                        role="button">Delete</a>
                                    <a class="btn btn-warning" href="../replies/update.php?id=<?php echo $reply->id; ?>"
                                        role="button">Update</a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <h3>Reply To Topic</h3>
                    <form role="form" method="POST" action="topic.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                            <script>
                            CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require '../includes/footer.php'; ?>