<?php  

function validate_subject($subject)
{
  $errors =[];

  if(is_blank($subject['menu_name']))
  {
    $errors[]= "Name can't be empty";
  }
  elseif(!has_length($subject['menu_name'],['min'=>2, 'max'=>255]))
  {
    $errors[]= "name must be in between 2 and 255 characters";
  }

  //position
  $position_int = (int)$subject['position'];
  if($position_int<0)
  {
    $errors[]= "Position has to be greater than 0.";
  }
  if($position_int>999)
  {
    $errors[]= "Position has to be less than 1000";
  }
  
  //visible
  $visible_str=(string)$subject['visible'];
  if(!has_inclussion_of($visible_str,["0","1"]))
  {
    $errors[]= "Visible has to be true or false";
  }

  return $errors;
}

function validate_page($page)
{
  $errors=[];

  if(is_blank($page['menu_name']))
  {
    $errors[]= "Name can't be empty";
  }
  elseif(!has_length($page['menu_name'],['min'=>2, 'max'=>255]))
  {
    $errors[]= "name must be in between 2 and 255 characters";
  }
  $current_id =$page['id']??'0';
  if(!has_unique_page_menu_name($page['menu_name'],$current_id))
  {
    $errors[]= "Page name you entered already exist.";

  }

  //subject id
  if(!if_id_exist($page['subject_id']))
  {
    $errors[]="The subject you selected can't be found.";
  }
  //position
  $position_int = (int)$page['position'];
  if($position_int<0)
  {
    $errors[]= "Position has to be greater than 0.";
  }
  if($position_int>999)
  {
    $errors[]= "Position has to be less than 1000";
  }
  
  //visible
  $visible_str=(string)$page['visible'];
  if(!has_inclussion_of($visible_str,["0","1"]))
  {
    $errors[]= "Visible has to be true or false";
  }

  //content
  if(is_blank($page['content']))
  {
    $errors[]= "Content can't be empty";
  }

  return $errors;
}

function if_id_exist($id)
{
  global $db;
  $sql = "SELECT id FROM subjects ";
  $sql.= "WHERE id='".db_escape($db, $id)."'";
  $result = mysqli_query($db,$sql);

  if(mysqli_num_rows($result)>=1)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function find_all_subjects()
{
  global $db;
  $sql = "SELECT * FROM subjects ";
  $sql.= "ORDER BY position ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  return $result;
}

function find_all_pages()
{
  global $db;
  $sql = "SELECT pages.*, subjects.menu_name AS 'subject_name' FROM pages,subjects ";
  $sql.= "WHERE pages.subject_id=subjects.id ";
  $sql.= "ORDER BY subject_id ASC, position ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  return $result;

}

function find_subject_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM subjects ";
  $sql.= "WHERE id='".db_escape($db, $id)."'";
  $result = mysqli_query($db,$sql);
  confirm_result_set($result);

  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

  return $subject;
}

function insert_subject($subject)
{
  global $db;

  $errors = validate_subject($subject);

  if(!empty($errors))
  {
    return $errors;
  }

  $sql= 'INSERT INTO subjects ';
  $sql.='(menu_name, position, visible) ';
  $sql.='VALUES (';
  $sql.= "'".db_escape($db,$subject['menu_name'])."',";
  $sql.= "'".db_escape($db,$subject['position'])."',";
  $sql.= "'".db_escape($db,$subject['visible'])."'";
  $sql.=")";

  $result = mysqli_query($db, $sql);

  if($result)
  {
    return true;
  }
  else
  {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_subject($subject)
{
  global $db;
  $errors = validate_subject($subject);

  if(!empty($errors))
  {
    return $errors;
  }
  $sql = "UPDATE subjects SET ";
  $sql.="menu_name='".db_escape($db,$subject['menu_name'])."', ";
  $sql.="position='".db_escape($db,$subject['position'])."', ";
  $sql.="visible='".db_escape($db,$subject['visible'])."' ";
  $sql.="WHERE id='".db_escape($db,$subject['id'])."' ";
  $sql.="LIMIT 1";


  $result = mysqli_query($db, $sql);

  if($result)
  {
    return true;
  }
  else
  {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_subject($id)
{
  global $db;
  $errors=[];

  $ret = delete_subject_condition_met($id);

  if($ret===true)
  {
    $sql = "DELETE FROM subjects ";
    $sql.= "WHERE id ='".db_escape($db,$id)."' ";
    $sql.= "LIMIT 1";
  
    $result = mysqli_query($db, $sql);
  
    if($result)
    {
      return true;
    }
    else
    {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  else
  {
    $errors[]="The subject has existing pages. Please delete the pages related to subject first.";
    return $errors;
  }



}

function find_page_by_id($id)
{
  global $db;

  $sql= "SELECT pages.*, subjects.menu_name AS 'subject' ";
  $sql.= "FROM pages, subjects ";
  $sql.= "WHERE pages.id = '".db_escape($db,$id)."' AND pages.subject_id = subjects.id;";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $page = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $page;
}


function insert_page($page)
{
  global $db;
  $errors = validate_page($page);

  if(!empty($errors))
  {
    return $errors;
  }

  $sql = "INSERT INTO pages ";
  $sql.="(subject_id, menu_name, position, visible, content) ";
  $sql.='VALUES (';
  $sql.="'".db_escape($db,$page['subject_id'])."', ";
  $sql.= "'".db_escape($db,$page['menu_name'])."',";
  $sql.= "'".db_escape($db,$page['position'])."',";
  $sql.= "'".db_escape($db,$page['visible'])."', ";
  $sql.="'".db_escape($db,$page['content'])."'";
  $sql.=")";

  
  $result = mysqli_query($db, $sql);

  if($result)
  {
    return true;
  }
  else{
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function update_page($page)
{
  global $db;

  $errors = validate_page($page);

  if(!empty($errors))
  {
    return $errors;
  }

  $sql= "UPDATE pages SET ";
  $sql.="menu_name='".db_escape($db,$page['menu_name'])."', ";
  $sql.="subject_id='".db_escape($db,$page['subject_id'])."', ";
  $sql.="position='".db_escape($db,$page['position'])."', ";
  $sql.="visible='".db_escape($db,$page['visible'])."', ";
  $sql.="content='".db_escape($db,$page['content'])."' ";
  $sql.="WHERE id='".db_escape($db,$page['id'])."' ";
  $sql.="LIMIT 1";

  echo($sql);
  $result = mysqli_query($db, $sql);
  if($result)
  {
    return true;
  }
  else{
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function has_unique_page_menu_name($name, $id="0")
{
  global $db;
  $sql = "SELECT menu_name FROM pages ";
  $sql.= "WHERE menu_name='".db_escape($db,$name)."' ";
  $sql.= "AND id!='".db_escape($db,$id)."'";
  $result = mysqli_query($db,$sql);

  if(mysqli_num_rows($result)>=1)
  {
    return false;
  }
  else
  {
    return true;
  }
}

function delete_page($id)
{
  global $db;
  $sql = "DELETE FROM pages ";
  $sql.= "WHERE id='".db_escape($db,$id)."'";
  $sql.= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result)
  {
    return true;
  }
  else
  {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

}

function  delete_subject_condition_met($id)
{
  global $db;
  $sql = "SELECT * FROM pages ";
  $sql.= "WHERE subject_id='".db_escape($db,$id)."'";
  
  $result = mysqli_query($db,$sql);

  if(mysqli_num_rows($result)>0)
  {
    return false;
  }
  else
  {
    return true;
  }

}
?>