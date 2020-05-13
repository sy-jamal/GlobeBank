<?php require_once('../../../private/initialize.php');
    $page_name = '';
    $position = '';
    $visible= '';
    $content='';

    if(is_post_request())
    {
        $page=[];
        $page['menu_name'] = $_POST['page_name'];
        $page['position'] = $_POST['position'];
        $page['visible']= $_POST['visible'];
        $page['subject_id'] = $_POST['subject_id'];
        $page['content']= $_POST['content'];

        // echo($page['subject_id']);
        insert_page($page);
        $page_id = mysqli_insert_id($db);
        redirect_to("/staff/pages/show.php?id=".$page_id);

    }
?>

<?php 
    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    $page_count= mysqli_num_rows(find_all_pages());
    $page=[];
    $page['position']= $page_count;
    $page['subject_id']=1;
    
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>

<div id = "content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to List</a>
    <div class ="page new">
        <h1>Create Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php');?>" method ='Post'>
            <dl>
                <dt>Menu Name</dt>
                <dd> <input type="text" name="page_name" value="<?php  echo h($page_name);?>"/></dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                    <?php 
                        while($subject= mysqli_fetch_assoc($subject_set))
                        {
                            echo "<option value =\"{$subject['id']}\""; 
                                if($page['subject_id'] == $subject['id'])
                                {
                                    echo 'selected';
                                }
                                echo ">{$subject['menu_name']}</option>";
                        }
                        mysqli_free_result($subject_set);
                    ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                    <?php 
                        for($i=1; $i<= $page_count; $i++)
                        {
                            echo "<option value =\"{$i}\""; 
                                if($page['position'] == $i)
                                {
                                    echo 'selected';
                                }
                                echo ">{$i}</option>";
                        }
                    ?>
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
            <dl>
                <dt>Content</dt>
                <dd><textarea name="content" id="" cols="60" rows="10" ></textarea></dd>
                
            </dl>
            <div id="operations"> 
                <input type="submit" value=" Create Page ">
            </div>
        </form>

    </div>
</div>

<?php include (SHARED_PATH.'/staff_footer.php'); ?>

