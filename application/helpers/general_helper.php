<?php
function is_user_loggedin(){
    $CI =& get_instance();
    $user_id = $CI->session->userdata('user_id');

    if(empty($user_id)){
        //session_destroy();
        //redirect("news/login");
        return false;
    }
    else{
        return true;
    }
}
