<?php require_once('../../../private/initialize.php');
    $page_name = '';
    $position = '';
    $visible= '';

    if(is_post_request())
    {
        $page_name = $_POST['page_name']??'';
        $position = $_POST['position']??'';
        $visible= $_POST['visible']??'';

        echo "The parameters are: <br>";
        echo "Page Name : ".$page_name."<br>";
        echo "Position : ".$position."<br>";
        echo "Visible : ".$visible;
    }
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>

<div id = "content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to List</a>
    <div class ="subject new">
        <h1>Create Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php');?>" method ='Post'>
            <dl>
                <dt>Menu Name</dt>
                <dd> <input type="text" name="page_name" value="<?php  echo h($page_name);?>"/></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($position=="1") {echo 'selected';}?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visisble</dt>
                <dd>
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1"<?php if($visible=="1"){ echo "checked";}?>>

                </dd>
            </dl>
            <div id="operations"> 
                <input type="submit" value=" Create Page ">
            </div>
        </form>

    </div>
</div>

<?php include (SHARED_PATH.'/staff_footer.php'); ?>
