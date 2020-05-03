<?php 

require_once('../../../private/initialize.php');

    if(is_post_request())
    {
        $menu_name = $_POST['menu_name']??'';
        $position = $_POST['position']??'';
        $visible = $_POST['visible']??'';
    
        echo "Form parameters are <br>";
        echo "Menu Name: ".$menu_name."<br/>";
        echo "Position: ".$position."<br/>";
        echo "Visisble : ".$visible."<br/>";
    }
    else
    {
        redirect_to('/staff/subjects/new.php');
    }

?>