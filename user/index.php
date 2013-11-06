<?php
include("../models/database.php");
//check for form submission
$user_id = $_SESSION['user']['user_id'];
$result = mysql_query("SELECT
                          p.*, u.fname, u.lname, DATE_FORMAT(p.created_date, '%M %d, %Y %h:%i %p') AS created_date
                        FROM posts p
                          INNER JOIN users u
                            ON u.user_id = p.user_id
                        WHERE p.deleted = 0
                            AND (p.user_id = $user_id OR p.user_id IN (SELECT follower_id FROM followers WHERE user_id = $user_id))
                        ORDER BY p.created_date DESC");

?>

<?php include("../controls/header.php"); ?>

<!-- content-wrap starts here -->
<div id="content-wrap" class="padding10">

    <div id="main">

        <h2>Welcome <?php echo $_SESSION['user']['fname']; ?>!</h2>
        <?php while ($row = mysql_fetch_assoc($result)) {
            ?>
            <blockquote>
                <p>
                    <?php echo $row['description']; ?>
                </p>
            </blockquote>
            <p class="post-footer align-left">
                By: <a href="#" class="readmore"><?php echo $row['fname'] . " " . $row['lname']; ?></a> |
                <span class="date"><?php echo $row['created_date']; ?></span>
            </p>
        <?php } ?>
        <div class="clear"></div>
        <br><br><br><br><br>
    </div>

    <div id="sidebar">
        <?php
        include("../controls/sidebar.php");
        ?>
    </div>
    <!-- content-wrap ends here -->

</div>

<?php include("../controls/footer.php"); ?>

