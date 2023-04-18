<?php 
     
     $sql = "SELECT COUNT(*) AS all_topics FROM topics";

	 $smt = $dba->prepare($sql);
	 $smt->execute();
	 $alltopics = $smt->fetch(PDO::FETCH_OBJ);

     // num of posts inside every category

     $categories = "SELECT categories.id AS id, categories.name AS name,
      COUNT(topics.category) AS count_category FROM categories LEFT JOIN topics ON 
      categories.name = topics.category GROUP BY (topics.category)";

	 $smtc = $dba->prepare($categories);
	 $smtc->execute();
	 $allcategories = $smtc->fetchAll(PDO::FETCH_OBJ);

     // forum stats
     // users count
     $users = "SELECT COUNT(*) AS count_users FROM users";

	 $smtu = $dba->prepare($users);
	 $smtu->execute();
	 $allusers = $smtu->fetch(PDO::FETCH_OBJ);

     // topics count
     $topics = "SELECT COUNT(*) AS count_topics FROM topics";

	 $smtt = $dba->prepare($topics);
	 $smtt->execute();
	 $alltopics_count = $smtt->fetch(PDO::FETCH_OBJ);

     // categories count
     $categories = "SELECT COUNT(*) AS count_categories FROM categories";

	 $smtc = $dba->prepare($categories);
	 $smtc->execute();
	 $allcategories_count = $smtc->fetch(PDO::FETCH_OBJ);
    

?>
<div class="col-md-4">
    <div class="sidebar">


        <div class="block">
            <h3>Categories</h3>
            <div class="list-group block ">
                <a href="#" class="list-group-item active">All
                    Topics <span class="badge pull-right"><?php echo $alltopics->all_topics ;?></span></a>
                <?php foreach($allcategories as $category) : ?>
                <a href="<?php echo PATH ; ?>/categories/show.php?name=<?php echo $category->name; ?>"
                    class="list-group-item"><?php echo $category->name; ?><span
                        class="color badge pull-right"><?php echo $category->count_category; ?></span></a>
                <?php endforeach ; ?>
            </div>
        </div>

        <div class="block" style="margin-top: 20px;">
            <h3 class="margin-top: 40px">Forum Statistics</h3>
            <div class="list-group">
                <a href="#" class="list-group-item">Total Number of Users:<span
                        class="color badge pull-right"><?php echo $allusers->count_users; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Topics:<span
                        class="color badge pull-right"><?php echo $alltopics_count->count_topics; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Categories: <span
                        class="color badge pull-right"><?php echo $allcategories_count->count_categories; ?></span></a>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo PATH;?>/js/bootstrap.js"></script>
</body>

</html>