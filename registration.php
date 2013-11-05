<?php
include("models/database.php");
//destroy session to make sure no entry without login
if (isset($_SESSION['user'])) {
    session_destroy();
}
//check for form submission
$fname = "";
$lname = "";
$email= "";
$phone = "";
$location = "";
$password = "";
if (isset($_POST['submit'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email= trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['phone']);
    $password = $_POST['password'];
    $result = mysql_query("INSERT INTO users VALUES(
                                0,
                                 '$fname',
                                 '$lname',
                                 '$email',
                                 '$password',
                                 current_timestamp(),
                                 current_timestamp(),
                                 '$phone',
                                 '$location'
                            )");
    $message = "Your account has been created successfully! Please login to access the blog.";
    //reset parameters
    $fname = "";
    $lname = "";
    $email= "";
    $phone = "";
    $location = "";
    $password = "";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <meta name="Description" content="Information architecture, Web Design, Web Standards."/>
    <meta name="Keywords" content="your, keywords"/>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta name="Distribution" content="Global"/>
    <meta name="Author" content=""/>
    <meta name="Robots" content="index,follow"/>

    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#data-form").submit(function (ev) {
                var errorCount = 0; //define your errorCount variable to zero before you
                var ids = new Array();
                //iterate using each, errorCount will be available inside your each iteration function.
                $('.required').each(
                    function () {
                        //Due to JavaScript clousures, you can access errorCount in this function.
                        if ($(this).val() == '')
                            ids[errorCount++] = $(this).attr('id');
                    }
                );

                //If we don't find any errors, we return. This will let the browser continue submitting the form.
                if (errorCount == 0)
                    return;

                //If control comes here, it means there were errors. Prevent form submission and display error message.
                ev.preventDefault();
                alert("Oops! you are missing something. Please fill all required fields.");
                $("#"+ids[0]).focus();
            });
        });
    </script>

    <title><?php echo WEBSITE_TITLE; ?> - Register</title>

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

            <h2>Registration Details</h2>
            <?php if (!empty($message)) { ?>
                <div class="message-success">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            <p>
                Already have an account? <a href="/login.php">Login</a> here.
            </p>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="data-form">
                <div class="full-width left">
                    <div class="display-label left">
                        <label>First Name</label>
                    </div>
                    <div class="display-data left">
                        <input name="fname" id="fname" value="<?php echo $fname; ?>" class="required input-field"
                               type="text"/>
                    </div>
                </div>
                <div class="full-width left">
                    <div class="display-label left">
                        <label>Last Name</label>
                    </div>
                    <div class="display-data left">
                        <input name="lname" id="lname" value="<?php echo $lname; ?>" class="required input-field"
                               type="text"/>
                    </div>
                </div>
                <div class="full-width left">
                    <div class="display-label left">
                        <label>Email</label>
                    </div>
                    <div class="display-data left">
                        <input name="email" id="email" value="<?php echo $email; ?>" class="required input-field"
                               type="text"/>
                    </div>
                </div>
                <div class="full-width left">
                    <div class="display-label left">
                        <label>Phone(Optional)</label>
                    </div>
                    <div class="display-data left">
                        <input name="phone" id="phone" value="<?php echo $phone; ?>" class="input-field"
                               type="text"/>
                    </div>
                </div>
                <div class="full-width left">
                    <div class="display-label left">
                        <label>Location(Optional)</label>
                    </div>
                    <div class="display-data left">
                        <textarea name="location" id="location"class="textarea-panel"><?php echo $location; ?></textarea>
                    </div>
                </div>

                <div class="full-width left">
                    <div class="display-label left">
                        <label>Password</label>
                    </div>
                    <div class="display-data left">
                        <input name="password" id="password" value="<?php echo $password; ?>" class="required input-field"
                               type="password"/>
                    </div>
                </div>
                <br/>

                <div class="full-width left">
                    <div class="display-label left">
                        &nbsp;
                    </div>
                    <div class="display-data left">
                        <input class="button" type="submit" value="Register" name="submit"/>
                    </div>
                </div>
            </form>
        </div>

        <div id="sidebar">

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
