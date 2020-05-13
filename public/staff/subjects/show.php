<?php require_once('../../../private/initialize.php'); ?>


<?php 
    $id = $_GET['id'] ?? 1;
    $page_title= 'Subjects-'.$id;
?>

<?php require(SHARED_PATH.'/staff_header.php'); ?>
<?php 
    $result= find_subject_by_id($id);
?>

<div id='content'>
<a class='action' href="<?php echo url_for('staff/subjects/index.php') ;?>"><<--Go back to previous page</a> <br /> <br />

<div class ="subject show">
    <h1>Subject: <?php echo h($result['menu_name']); ?></h1>
    <div class="attributes">
        <dl>
            <dt>Menu Name</dt>
            <dd><?php echo h($result['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($result['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo $result['visible']=='1'?'true':'false'; ?></dd>

        </dl>
    </div>
</div>
</div>


<br />

<?php require(SHARED_PATH.'/staff_footer.php'); ?>
