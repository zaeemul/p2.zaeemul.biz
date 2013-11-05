<?php
if(!isset($_SESSION['user']) || !isset($_SESSION))
{
    header("Location: ../index.php");
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

    <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
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

            //set confirmation message
            $('.confirmation').click(function(){
                if(!confirm("Are you sure to remove this record ?"))
                {
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
            <li><a href="posts.php">Manage Posts</a></li>
            <li><a href="users.php">Browse Users</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </div>
