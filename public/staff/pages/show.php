<?php require_once('../../../private/initialize.php'); ?>
<?php 
    $id = $_GET['id'] ?? 1;        
    $page = find_page_by_id(h($id));

?>


<?php $page_title= 'Page-'.$id?>
<?php require(SHARED_PATH.'/staff_header.php') ?>

<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to List</a>

    <div class = 'page show'>
    <h1>Page:  <?php echo ($page['menu_name']); ?></h1>
    <div class='attribrutes'>
        <dl>
            <dt>Menu_name: </dt>
            <dd><?php echo($page['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Subject: </dt>
            <dd><?php echo($page['subject']); ?></dd>
        </dl>
        <dl>
            <dt>Position:</dt>
            <dd><?php echo($page['position']); ?></dd>
        </dl>
            <dt>Visible:</dt>
            <dd><?php echo ($page['visible']==1)? "True":"False"; ?></dd>
        <dl>
            <dt>Content: </dt>
            <dd><?php echo ($page['content']); ?></dd>
        </dl>
    
    </div>
    </div>
</div>


<?php require(SHARED_PATH.'/staff_footer.php') ?>
