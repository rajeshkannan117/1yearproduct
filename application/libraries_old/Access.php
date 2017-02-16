<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Access
 *
 * @author innoppl
 */
class Access {
    //put your code here
    //public $permission = array('create','update','read','delete');
    
   
    /* Check menu acccess */
    public function check_menu_access($menu='dashboard',$access = array()){
        $count = count(access);
        if($count === 4){
            return true;
        }elseif($count == 0){
            return false;
        }
        if(in_array($menu,$access)){
            return true;
        }
        return false;
    }
    
    /* Check create edit access */
     public function check_create_edit_access($menu='dashboard',$access = array(),$permission){
        $count = count(access);
        if($count === 4){
            return true;
        }elseif($count == 0){
            return false;
        }
        if(in_array($permission,$access)){
            return true;
        }else{
            return false;
        }
    }
    
    /* Check View access */
    public function check_data_view_access($menu = 'dashboard',$access = array(),$permission){
        $count = count(access);
        if($count === 4){
            return true;
        }elseif($count == 0){
            return false;
        }
        if(in_array($permission,$access[$menu])){
            return true;
        }
        return false;
    }
    
    /* Check Delete Access */
    public function check_data_delete_access($menu = 'dashboard',$access = array(),$permission){
        $count = count(access);
        if($count === 4){
            return true;
        }elseif($count == 0){
            return false;
        }
        if(in_array($permission,$access[$menu])){
            return true;
        }
        return false;
    }
    /* Check update access */
    
    public function check_data_update_access($menu = 'dashboard',$access = array(),$permission){
        
        if(in_array($permission,$access[$menu])){
            return true;
        }
        return false;
    }
    
    public function check_all_access($menu = 'dashboard',$access = array()){
        $count = count($access[$menu]);
        if($count === 4){
            return true;
        }elseif($count == 0){
            return false;
        }
    }
}
