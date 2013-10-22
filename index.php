<?php
include("models/database.php");
//destroy session to make sure no entry without login
if (isset($_SESSION['user'])) {
    session_destroy();
    $close = "yes";
}
//check for form submission
$username = "";
$password = "";
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $result = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");
    if (mysql_num_rows($result) <= 0) {
        $error = "error";
    } else {
        $_SESSION['user'] = mysql_fetch_assoc($result);
        header("Location: ./user/");
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <meta name="Description" content="Information architecture, Web Design, Web Standards."/>
    <meta name="Keywords" content="your, keywords"/>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta name="Distribution" content="Global"/>
    <meta name="Author" content="Attacomsian"/>
    <meta name="Robots" content="index,follow"/>

    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#data-form").submit(function () {
                if ($("#username").val().length == 0 || $("#password").val().length == 0) {
                    alert("Please enter both username and password");
                    return false;
                }
            });
        });
    </script>

    <title><?php echo WEBSITE_TITLE; ?></title>

</head>

<body>
<!-- wrap starts here -->
<div id="wrap">

    <!--header -->
    <div id="header">

        <h1 id="logo-text"><a href="index.php"><?php echo WEBSITE_TITLE; ?></a></h1>

        <p id="slogan"><?php echo SLOGAN; ?></p>

    </div>

    <!-- navigation -->
    <div id="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Registration</a></li>
        </ul>
    </div>

    <!-- content-wrap starts here -->
    <div id="content-wrap" class="padding10">

        <div id="main">

            <h2>Welcome to <?php echo WEBSITE_TITLE; ?>!</h2>

            <p>
                Following are the things you can find here.
            <ul>
                <li><strong>Log in</strong></li>
                <li><strong>Sign up</strong></li>
                <li><strong>Add Post</strong></li>
                <li><strong>Follow / Unfollow Users</strong></li>
                <li><strong>View Posts Stream</strong></li>
            </ul>
            <br/>
            <h3>+1 Features</h3>
            <ul>
                <li><strong>Delete Post</strong></li>
                <li><strong>Edit Post</strong></li>
            </ul>
            </p>
        </div>

        <div id="sidebar">
            <h2>Quick Links</h2>
            <ul class="sidemenu">
                <li><a href="login.php">Login</a></li>
                <li><a href="registration.php">Create Account</a></li>
            </ul>
        </div>
        <!-- content-wrap ends here -->
        <div class="clear"></div>
        <br/><br/><br/><br/>
    </div>

    <!--footer starts here-->
    <div id="footer">

        <p>
            &copy; 2013 <strong><?php echo FOOTER_NOTE; ?></strong>
        </p>

    </div>

    <!-- wrap ends here -->
</div>

</body>
</html>
