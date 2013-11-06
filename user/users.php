<?php
include("../models/database.php");
//check for form submission
$user_id = $_SESSION['user']['user_id'];
//check for delete operation
if(isset($_REQUEST['id']) && isset($_REQUEST['op']) && $_REQUEST['op'] == 'f' )
{
    $id = $_REQUEST['id'];
    mysql_query("INSERT INTO followers VALUES(0, $user_id, $id, current_timestamp())");
    $message = "Status has been changed successfully!";
    $id = "";
}
else if(isset($_REQUEST['id']) && isset($_REQUEST['op']) && $_REQUEST['op'] == 'u' )
{
    $id = $_REQUEST['id'];
    $result = mysql_query("DELETE FROM followers WHERE followup_id = $id");
    $message = "Status has been changed successfully!";
    $id = "";
}

$result = mysql_query("SELECT
                      u.user_id,
                      u.fname,
                      u.lname,
                      f.followup_id,
                      DATE_FORMAT(u.registration_date, '%M %d, %Y') AS joining_date
                    FROM users u
                      LEFT JOIN followers f
                        ON f.follower_id = u.user_id
                    WHERE u.user_id <> $user_id
                    ORDER BY followup_id DESC");

?>

<?php include("../controls/header.php"); ?>

<!-- content-wrap starts here -->
<div id="content-wrap" class="padding10">

    <div id="main">
        <?php if(!empty($message)) {?>
            <div class="message-success">
                <?php echo $message;?>
            </div>
        <?php }?>
        <h2>View Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Member Since</th>
                <th class="acenter">Status</th>
            </tr>
            <?php while($row = mysql_fetch_assoc($result))
            { ?>
                <tr>
                    <td><?php echo $row['fname'].' '.$row['lname'];?></td>
                    <td><?php echo $row['joining_date'];?></td>
                    <td class="acenter">
                        <?php if(!empty($row['followup_id']))
                        {?>
                            <div class="badge badge-success">
                                <a href="users.php?op=u&id=<?php echo $row['followup_id'];?>"
                                  title="Click to stop following" class="confirmation">Following</a>
                            </div>
                        <?php
                        }
                        else
                        {?>
                            <div class="badge badge-info">
                                <a href="users.php?op=f&id=<?php echo $row['user_id'];?>"
                                    title="Click to follow">Follow</a>
                            </div>
                        <?php }?>
                    </td>
                </tr>
            <?php }?>
        </table>
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

