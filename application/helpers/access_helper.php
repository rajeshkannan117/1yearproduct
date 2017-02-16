<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

function action_return($perm = array(),$menu='',$action_id,$user_id ='',$created_by = ''){
    $view = ''; 
    //print_r($perm);
    if($menu === 'form'){
        $edit = 'edit_detail';
    }
    else{
        $edit = 'edit';
    }
    if(!in_array('update',$perm) && !in_array('create',$perm)){
           $view .='N/A';
    }else{
        if(in_array('update',$perm)){
            $view .='<a href="'.base_url().$menu.'/'.$edit.'/'.$action_id.'" title="Edit"><i class="md-icon material-icons">&#xE254;</i></a>';
        }else{
            if(in_array('create',$perm)){
                if($user_id === $created_by){
                    $view .='<a href="'.base_url().$menu.'/'.$edit.'/'.$action_id.'" title="Edit"><i class="md-icon material-icons">&#xE254;</i></a>';
                }
                else{
                    $view .='N/A';
                }
            }
        }
    }
    return $view;
}

function access_edit($perm = array(),$menu='',$user_id ='',$created_by = ''){
    if(!in_array('update',$perm) && !in_array('create',$perm)){
           return false;
    }else{
        if(in_array('update',$perm)){
            return true;
        }else{
            if(in_array('create',$perm)){
                if($user_id === $created_by){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    }
    
}

function define_constants(){
    //$url = 'http://www.innoforms.com/';
    $current_url = substr(base_url(),7,strpos(substr(base_url(),7),'/'));
    //echo $current_url = substr($url,7,strpos(substr($url,7),'/'));exit;
    if($current_url === 'localhost'){
        define('LOGOS_IMAGE_PATH', '/var/www/html/Innoforms/uploads/logos/');
        define('LOGOS_THUMB_IMAGE_PATH', '/var/www/html/Innoforms/uploads/logos/thumb/');
        define('IMAGE_PATH', '/var/www/html/Innoforms/uploads/user/');
        define('IMAGE_PATH_SIGNATURE', '/var/www/html/Innoforms/uploads/signature/');
        define('THUMB_IMAGE_PATH', '/var/www/html/Innoforms/uploads/user/thumb/');
        define('FORM_LIVE_PATH','/var/www/html/Innoforms/uploads/');
        define('FORM_DEV_PATH','/var/www/html/Innoforms/uploads/');
        define('FORM_REPORT_PATH','/var/www/html/Innoforms/uploads/report/');
        define('PEM_URL','/var/www/html/Innoforms/pem/');
    }else if($current_url === 'formpro.enterpriseapplicationdevelopers.com'){
        define('LOGOS_IMAGE_PATH', '/var/www/formpro/uploads/logos/');
        define('LOGOS_THUMB_IMAGE_PATH', '/var/www/formpro/uploads/logos/thumb/');
        define('IMAGE_PATH', '/var/www/formpro/uploads/user/');
        define('IMAGE_PATH_SIGNATURE', '/var/www/formpro/uploads/signature/');
        define('THUMB_IMAGE_PATH', '/var/www/formpro/uploads/user/thumb/');
        define('FORM_LIVE_PATH','/var/www/formpro/uploads/');
        define('FORM_DEV_PATH','/var/www/formpro/uploads/');
        define('FORM_REPORT_PATH','/var/www/formpro/uploads/report/');
        define('PEM_URL','/var/www/formpro/pem/');
    }
    else if($current_url === 'formpro-dev.enterpriseapplicationdevelopers.com'){
        define('LOGOS_IMAGE_PATH', '/var/www/formpro-dev/uploads/logos/');
        define('LOGOS_THUMB_IMAGE_PATH', '/var/www/formpro-dev/uploads/logos/thumb/');
        define('IMAGE_PATH', '/var/www/formpro-dev/uploads/user/');
        define('IMAGE_PATH_SIGNATURE', '/var/www/formpro-dev/uploads/signature/');
        define('THUMB_IMAGE_PATH', '/var/www/formpro-dev/uploads/user/thumb/');
        define('FORM_LIVE_PATH','/var/www/formpro-dev/uploads/');
        define('FORM_DEV_PATH','/var/www/formpro-dev/uploads/');
        define('FORM_REPORT_PATH','/var/www/formpro-dev/uploads/report/');
        define('PEM_URL','/var/www/formpro-dev/pem/');
    }
    else if($current_url === 'www.innoforms.com'){
        define('LOGOS_IMAGE_PATH', '/var/www/html/innoforms.com/public_html/uploads/logos/');
        define('LOGOS_THUMB_IMAGE_PATH', '/var/www/html/innoforms.com/public_html/uploads/logos/thumb/');
        define('IMAGE_PATH', '/var/www/html/innoforms.com/public_html/uploads/user/');
        define('IMAGE_PATH_SIGNATURE', '/var/www/html/innoforms.com/public_html/uploads/signature/');
        define('THUMB_IMAGE_PATH', '/var/www/html/innoforms.com/public_html/uploads/user/thumb/');
        define('FORM_LIVE_PATH','/var/www/html/innoforms.com/public_html/uploads/');
        define('FORM_DEV_PATH','/var/www/html/innoforms.com/public_html/uploads/');
        define('FORM_REPORT_PATH','/var/www/html/innoforms.com/public_html/uploads/report/');
        define('PEM_URL','/var/www/html/innoforms.com/public_html/pem/');
    }
}
