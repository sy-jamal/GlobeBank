<?php require_once('../../../private/initialize.php'); ?>


<?php 
    $id = $_GET['id'] ?? 1;
    $page_title= 'Subjects-'.$id;
?>

<?php require(SHARED_PATH.'/staff_header.php'); ?>

<div id='content'>
<a class='action' href="<?php echo url_for('staff/pages/index.php') ;?>"><<--Go back to previous page</a> <br /> <br />

<?php

    // h() deals with unintentional html chars function.php 
    echo h($id);

?>
</div>


<br />
<a href="show.php?name=<?php echo u('jonh doe');?>">Link</a> <br />

<?php require(SHARED_PATH.'/staff_footer.php'); ?>
