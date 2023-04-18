<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 
if(!isset($_SESSION['username'])) {
    header("location: ".PATH."");
  }

if(isset($_GET['name'])){
     $name = $_GET['name'];
	 $sql = "SELECT * FROM users WHERE username = '$name'";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $users = $smt->fetch(PDO::FETCH_OBJ);
     
     // num of topics for every user
     $num_topic = "SELECT COUNT(*) AS num_topics FROM topics WHERE user_name = '$name'";

	 $smtn = $dba->prepare($num_topic);
	 $smtn->execute();
	 $num_topics = $smtn->fetch(PDO::FETCH_OBJ);

     // num of replies for every user
     $num_replies = "SELECT COUNT(*) AS num_replies FROM replies WHERE user_name = '$name'";

	 $smtn = $dba->prepare($num_replies);
	 $smtn->execute();
	 $num_replies = $smtn->fetch(PDO::FETCH_OBJ);
     
     

}  

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><?php echo $users->name ;?></h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="../img/<?php echo $users->avatar ;?>">
                                        <ul>
                                            <li><strong><?php echo $users->username ;?></strong></li>
                                            <li><a href="profile.php?name=<?php echo $users->username ;?>">Profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>
                                            <?php echo $users->about ;?>
                                        </p>
                                    </div>
                                    <a class="btn btn-success" href="" role="button">number of posts :
                                        <?php echo $num_topics->num_topics; ?></a>
                                    <a class="btn btn-primary" href="" role="button">number of replies :
                                        <?php echo $num_replies->num_replies; ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php" ?>