<?php

/**
 * Helper to check if user is logged in
 *
 * @return bool
 */
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


/**
 * This helper will convert a text into excerpt if max length exceeds 100 character length
 *
 * @param $str
 * @param int $startPos
 * @param int $maxLength
 * @return string
 */
function getExcerpt($str, $startPos = 0, $maxLength = 100)
{
    if (strlen($str) > $maxLength) {
        $excerpt = substr($str, $startPos, $maxLength - 3);
        $lastSpace = strrpos($excerpt, ' ');
        $excerpt = substr($excerpt, 0, $lastSpace);
        $excerpt .= '...';
    } else {
        $excerpt = $str;
    }

    return $excerpt;
}

/**
 * Function to convert timestamp to relative time
 *
 * @param String $timestamp
 * @return bool|string
 */
function time2str($ts) {
    if (!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if ($diff == 0)
        return 'now';
    elseif ($diff > 0) {
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 60)
                return 'just now';
            if ($diff < 120)
                return '1 minute ago';
            if ($diff < 3600)
                return floor($diff / 60) . ' minutes ago';
            if ($diff < 7200)
                return '1 hour ago';
            if ($diff < 86400)
                return floor($diff / 3600) . ' hours ago';
        }
        if ($day_diff == 1)
            return 'Yesterday';
        if ($day_diff < 7)
            return $day_diff . ' days ago';
        if ($day_diff < 31)
            return ceil($day_diff / 7) . ' weeks ago';
        if ($day_diff < 60)
            return 'last month';
        return date('F Y', $ts);
    }
    else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 120)
                return 'in a minute';
            if ($diff < 3600)
                return 'in ' . floor($diff / 60) . ' minutes';
            if ($diff < 7200)
                return 'in an hour';
            if ($diff < 86400)
                return 'in ' . floor($diff / 3600) . ' hours';
        }
        if ($day_diff == 1)
            return 'Tomorrow';
        if ($day_diff < 4)
            return date('l', $ts);
        if ($day_diff < 7 + (7 - date('w')))
            return 'next week';
        if (ceil($day_diff / 7) < 4)
            return 'in ' . ceil($day_diff / 7) . ' weeks';
        if (date('n', $ts) == date('n') + 1)
            return 'next month';
        return date('F Y', $ts);
    }
}

function get_username($id){
    $CI =& get_instance();
    $CI->load->model('news_model');
    $username = $CI->news_model->get_username($id);

    return $username->full_name;
}
