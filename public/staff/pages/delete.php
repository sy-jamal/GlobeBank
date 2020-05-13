<?php require_once('../../../private/initialize.php'); ?>

<?php 
    if(!isset($_GET['id']))
    {
        redirect_to('/staff/pages/index.php');
    }

    $id = $_GET['id'];

    if(is_post_request())
    {
        delete_page($id);
        redirect_to('/staff/pages/index.php');
    }
    else{
        $page = find_page_by_id($id);
    }
?>
<?php  $page_title = "Delete Page" ?> 

<?php require(SHARED_PATH. '/staff_header.php'); ?>

<div id="content">
    <a class ="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to List</a>

    <div class="Page Delete">
    <p>Are you sure you want to delete page</p>
    <p class ="item"><?php echo h($page['menu_name']) ?></p>

    <form action="<?php echo url_for('/staff/pages/delete.php?id='.$id);?>" method="post">
        <div id = "operations">
            <input type="submit" name="comit" value = "Delete Page">
        </div>
    
    </form>
    
    </div>

</div>

<?php require(SHARED_PATH.'/staff_footer.php') ?>
