<?php 
session_start();
define("PATH","http://localhost/forum");?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To Forum</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo PATH;?>/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo PATH;?>/css/custom.css" rel="stylesheet">
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo PATH; ?>">Forum</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="<?php echo PATH; ?>">Home</a></li>
                    <?php if(isset($_SESSION['username'])) : ?>
                    <li><a href="<?php echo PATH;?>/topics/create.php">Create Topic</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a
                                    href="<?php echo PATH; ?>/users/profile.php?name=<?php echo $_SESSION['username']; ?>">Public
                                    Profile</a></li>
                            <li><a
                                    href="<?php echo PATH; ?>/users/edit_user.php?id=<?php echo $_SESSION['user_id']; ?>">Edit
                                    Profile</a></li>
                            <li><a href="<?php echo PATH; ?>/auth/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php else : ?>
                    <li><a href="<?php echo PATH; ?>/auth/register.php">Register</a></li>
                    <li><a href="<?php echo PATH; ?>/auth/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>