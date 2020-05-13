<?php require_once('../../../private/initialize.php'); ?>

<?php 
    $pages_set= find_all_pages();

?>

<?php $page_title = 'Pages' ?>

<?php require(SHARED_PATH.'/staff_header.php'); ?>

<div id='content'>
      <div class="pages listing">
        <h1>Pages</h1>

        <div class= "actions">
            <a class="actions" href="<?php echo(url_for('/staff/pages/new.php/'));?>">Create New Page</a>
            <br />
            <br />
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th> 
                <th>Content</th>               
                <th>&nbsp</th>
                <th>&nbsp</th>
                <th>&nbsp</th>  
            </tr>

            <?php while($page= mysqli_fetch_assoc($pages_set)){?>
                <tr>
                    <td> <?php echo h($page['id']) ?> </td>
                    <td> <?php echo h($page['subject_name']) ?></td>
                    <td> <?php echo h($page['position'] )?></td>
                    <td> <?php echo $page['visible']==1 ? 'True' : 'False' ?></td>
                    <td> <?php echo h($page['menu_name'] )?></td>
                    <td> <?php echo h($page['content']) ?></td>
                    <td><a  class="action" href="<?php echo url_for('/staff/pages/show.php?id='.$page['id']);?> ">View</a> </td>
                    <td> <a class="action" href="<?php echo url_for('/staff/pages/edit.php?id='.$page['id']);?> ">Edit</a></td>
                    <td> <a class="action" href="<?php echo url_for('/staff/pages/delete.php?id='.$page['id']);?>">Delete</a></td>
                </tr>
            <?php } ?>
            
        
        </table>
        <?php 
            mysqli_free_result($pages_set);
        ?>
        
      
      </div>
</div>

<?php require_once(SHARED_PATH.'/staff_footer.php'); ?>