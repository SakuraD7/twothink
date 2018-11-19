<?php
 
namespace app\home\validate;
use think\Validate; 

class Property extends Validate{
     
    protected $rule = [ 
        ['reason', 'require', '报修原因不能为空'],
        ['name', 'require', '姓名不能为空'],
        ['tel', 'require', '联系方式不能为空'],
        ['address', 'require', '地址不能为空'],
        ['contents', 'require', '详细情况不能为空'],
    ];
}