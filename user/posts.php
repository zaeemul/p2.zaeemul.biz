<?php
include("../models/database.php");

$message = "";
$id = "";
$data = array('description'=>'');

//check for form submission
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user']['user_id'];

    if(empty($id))
    {
        mysql_query("INSERT INTO posts VALUES(0, '$description',current_timestamp(),current_timestamp(), 0, $user_id)");
        $message = "Post has been added successfully!";
    }
    else
    {
        mysql_query("UPDATE posts SET description = '$description',updated_date = current_timestamp() WHERE post_id = $id");
        $message = "Post has been updated successfully!";
        $id = "";
    }
}
//check for delete operation
if(isset($_REQUEST['id']) && isset($_REQUEST['op']) && $_REQUEST['op'] == 'delete' )
{
    $id = $_REQUEST['id'];
    mysql_query("UPDATE posts SET deleted = 1 WHERE post_id = $id");
    $message = "Post has been deleted successfully!";
    $id = "";
}
else if(isset($_REQUEST['id']) && isset($_REQUEST['op']) && $_REQUEST['op'] == 'edit' )
{
    $id = $_REQUEST['id'];
    $result = mysql_query("SELECT * FROM posts  WHERE post_id = $id LIMIT 1");
    $data = mysql_fetch_assoc($result);
}
//fetch all announcements
$user_id = $_SESSION['user']['user_id'];
$result = mysql_query("SELECT * FROM posts  WHERE deleted = 0 AND user_id = $user_id ORDER BY created_date");
?>

<?php include("../controls/header.php"); ?>

<!-- content-wrap starts here -->
<div id="content-wrap" class="padding10">

    <div id="main">

        <h2>Add New Post</h2>
        <?php if(!empty($message)) {?>
            <div class="message-success">
                <?php echo $message;?>
            </div>
        <?php }?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="data-form">
            <div class="full-width left">
                <div class="display-label left">
                    <label>Enter Text</label>
                </div>
                <div class="display-data left">
                    <textarea name="description" id="description" class="required textarea-panel"><?php echo $data['description']; ?></textarea>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                </div>
            </div>

            <br/>

            <div class="full-width left">
                <div class="display-label left">
                    &nbsp;
                </div>
                <div class="display-data left">
                    <input class="button" type="submit" value="Submit" name="submit"/>
                </div>
            </div>
        </form>

        <span class="clearfix"></span>
        <br/>
        <br/>
        <br/>
        <!--show existing announcements in table-->
        <h2>Existing Posts</h2>
        <table>
            <tr>
                <th>Description</th>
                <th class="acenter">Action</th>
            </tr>
            <?php while($row = mysql_fetch_assoc($result))
            { ?>
                <tr>
                    <td><?php echo $row['description'];?></td>
                    <td class="acenter">
                        <a href="posts.php?op=edit&id=<?php echo $row['post_id'];?>">Edit</a> &nbsp;&nbsp;
                        <a href="posts.php?op=delete&id=<?php echo $row['post_id'];?>" class="confirmation">Delete</a>
                    </td>
                </tr>
            <?php }?>
        </table>

        <br/>
        <br/>
    </div>

    <div id="sidebar">
        <?php
        include("../controls/sidebar.php");
        ?>
    </div>
    <!-- content-wrap ends here -->
</div>

<?php include("../controls/footer.php"); ?>

