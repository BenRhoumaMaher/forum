<?php require "layouts/header.php" ?>
<?php require "../config/config.php"; ?>
<?php 

if(!isset($_SESSION['adminname'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
    }    

    $topic = "SELECT COUNT(*) AS count_topics FROM topics";
    $smt = $dba->prepare($topic);
    $smt->execute();
    $fetch = $smt->fetch(PDO::FETCH_OBJ);

    $category = "SELECT COUNT(*) AS count_categories FROM categories";
    $smt = $dba->prepare($category);
    $smt->execute();
    $fetch_category = $smt->fetch(PDO::FETCH_OBJ);

    $admins = "SELECT COUNT(*) AS count_admins FROM admins";
    $smt = $dba->prepare($admins);
    $smt->execute();
    $fetch_admin = $smt->fetch(PDO::FETCH_OBJ);

    $replies = "SELECT COUNT(*) AS count_replies FROM replies";
    $smt = $dba->prepare($replies);
    $smt->execute();
    $fetch_reply = $smt->fetch(PDO::FETCH_OBJ);

?>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Topics</h5>
                <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
                <p class="card-text">number of topics: <?php echo $fetch->count_topics; ?></p>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>

                <p class="card-text">number of categories: <?php echo $fetch_category->count_categories; ?></p>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Admins</h5>

                <p class="card-text">number of admins: <?php echo $fetch_admin->count_admins; ?></p>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Replies</h5>

                <p class="card-text">number of replies: <?php echo $fetch_reply->count_replies; ?></p>

            </div>
        </div>
    </div>
</div>
<?php require "layouts/footer.php" ?>