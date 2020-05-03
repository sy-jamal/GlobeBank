<?php require_once('../../../private/initialize.php'); ?>
<?php 
    $id = $_GET['id'] ?? 1;

    
?>

<?php $page_title= 'Page-'.$id?>
<?php require(SHARED_PATH.'/staff_header.php') ?>

<div id='content'>
    <a class='action' href="<?php echo url_for('staff/pages/index.php') ;?>"><<--Go back to previous page</a> <br /> <br />
    <?php echo "Page id is ".h($id); ?>
</div>


<?php require(SHARED_PATH.'/staff_footer.php') ?>
