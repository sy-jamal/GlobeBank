<?php require_once('../../../private/initialize.php');
    if(!isset($_GET['id']))
    {
        redirect_to('/staff/subjects/index.php');
    }
    $id = $_GET['id'];
    $menu_name='';
    $postion='';
    $visible=0;

    if(is_post_request())
    {
        $menu_name=$_POST['menu_name']??'';
        $postion=$_POST['position']??'';
        $visible=$_POST['visible']??'';

        echo "Form parameters are <br>";
        echo "Menu Name".$menu_name."<br>";
        echo "Position".$postion."<br>";
        echo "Visible".$visible.'<br>';
    }
?> 

<?php $page_title = 'Edit Subject'; ?>
<?php include (SHARED_PATH.'/staff_header.php'); ?>

<div id = "content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to List</a>
    <div class ="subject new">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/subjects/edit.php?id='.$id);?>" method ='Post'>
            <dl>
                <dt>Page  Name</dt>
                <dd> <input type="text" name="menu_name" value="<?php echo h($menu_name); ?>"/></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($postion=="1"){echo "selected";}?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1"<?php if($visible=="1"){echo 'checked';}?>>

                </dd>
            </dl>
            <div id="operations"> 
                <input type="submit" value="Edit Subject">
            </div>
        </form>

    </div>
</div>

<?php include (SHARED_PATH.'/staff_footer.php'); ?>