<?php require_once('../../../private/initialize.php'); ?>

<?php 
    if(!isset($_GET['id']))
    {
        redirect_to('/staff/subjectss/index.php');
    }
    $id= $_GET['id'];
    
    if(is_post_request())
    {
        delete_subject($id);
        redirect_to('/staff/subjects/index.php');

    }
    else{
        $subject = find_subject_by_id($id);
    }
    
?>

<?php 
    $page_title= "Delete Subject";
    require(SHARED_PATH.'/staff_header.php')
?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to List</a>
    <div class ="subject delete">
        <h1>Delete Subject</h1>
        <p>Are you sure you want to delete this subject</p>
        <p class="item"><?php echo h($subject['menu_name']) ?></p>
        <form action="<?php echo url_for('/staff/subjects/delete.php?id='.$id)?>" method="post">
            <div id="opetations">
            <input type="submit" name = "commit" value= "Delete Subject">
            </div>
        </form>
    </div>
</div>

<?php require(SHARED_PATH.'/staff_footer.php') ?>