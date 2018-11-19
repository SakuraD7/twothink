<?php
/**
 * Created by PhpStorm.
 * User: 学思
 * Date: 2018/11/16
 * Time: 14:51
 */

namespace app\home\controller;


use app\home\model\Document;

class My extends Home{
    public function index(){
        //判断用户是否登录
        //var_dump(5454);die;dsfqw  1`l
//        if(defined('UID'));
//        define('UID',is_login());
        if( !is_login() ){// 还没登录 跳转到登录页面
            $this->error('请登陆后再进行操作',url('/user/login'));
        }
        return $this->fetch();
        }

    public function fuwu(){
        if( !is_login() ){// 还没登录 跳转到登录页面
            $this->error('请登陆后再进行操作',url('/user/login'));
        }
        return $this->fetch();
    }

    public function yezhurenzheng(){
        if( !is_login() ){// 还没登录 跳转到登录页面
            $this->error('请登陆后再进行操作',url('/user/login'));
        }
        return $this->fetch();
    }

    //退出登录
    public function logout(){
        //var_dump(5454);
        if(is_login()){
            model('My')->logout();
            session('[destroy]');
            $this->success('退出成功！', url('login'));
        } else {
            $this->redirect('login');
        }
    }
}