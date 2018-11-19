<?php
/**
 * Created by PhpStorm.
 * User: 学思
 * Date: 2018/11/12
 * Time: 11:52
 */

namespace app\home\controller;

class Property extends Home {
    public function index($cate_id = null, $model_id = null, $position = null,$group_id=null){
        $groups =[];
        $model = null;
        $this->getMenus();
        if($cate_id===null){
            $cate_id = $this->cate_id;
        }
        if(!empty($cate_id)){
            $pid = input('pid',0);
            // 获取列表绑定的模型
            if ($pid == 0) {
                $models     =   get_category($cate_id, 'model');
                // 获取分组定义
                $groups		=	get_category($cate_id, 'groups');
                if($groups){
                    $groups	=	parse_field_attr($groups);
                }
            }else{ // 子文档列表
                $models     =   get_category($cate_id, 'model_sub');
            }
            if(is_null($model_id) && !is_numeric($models)){
                // 绑定多个模型 取基础模型的列表定义
                $model = \think\Db::name('Model')->getById($models);
                $model = \think\Db::name('Model')->getById($model['extend']);
            }else{
                $model_id   =   $model_id ? : $models;
                //获取模型信息
                $model = \think\Db::name('Model')->getById($model_id);
                if (empty($model['list_grid']) && !$model['extend'] == 0) {
                    $model['list_grid'] = \think\Db::name('Model')->getFieldById($model['extend'],'list_grid');
                    empty($model['list_grid']) && $this->error('未定义列表定义');
                }
            }
            $this->assign('model', explode(',', $models));
        }else{
            // 获取基础模型信息
            $model = \think\Db::name('Model')->getByName('document');
            $model_id   =   null;
            $cate_id    =   0;
            $this->assign('model', null);
        }
        //解析列表规则
        $fields =	array();
        $grids  =	preg_split('/[;\r\n]+/s', trim($model['list_grid']));
        foreach ($grids as &$value) {
            // 字段:标题:链接
            $val      = explode(':', $value);
            // 支持多个字段显示
            $field   = explode(',', $val[0]);
            $value    = array('field' => $field, 'title' => $val[1]);
            if(isset($val[2])){
                // 链接信息
                $value['href']  =   $val[2];
                // 搜索链接信息中的字段信息
                preg_replace_callback('/\[([a-z_]+)\]/', function($match) use(&$fields){$fields[]=$match[1];}, $value['href']);
            }
            if(strpos($val[1],'|')){
                // 显示格式定义
                list($value['title'],$value['format'])    =   explode('|',$val[1]);
            }
            foreach($field as $val){
                $array  =   explode('|',$val);
                $fields[] = $array[0];
            }
        }
        // 文档模型列表始终要获取的数据字段 用于其他用途
        $fields[] = 'category_id';
        $fields[] = 'model_id';
        $fields[] = 'pid';
        // 过滤重复字段信息
        $fields =   array_unique($fields);
        // 列表查询getDocumentList
        $fields = array_filter($fields);
        $list   =   $this->getResponseType($cate_id,$model_id,$position,$fields,$group_id);
        $pid = input('get.pid', 0);
        $list = \think\Db::name('Property')->order('id asc')->paginate(2);
        $this->assign('list', $list);
        $this->assign('id',$pid);
        $this->assign('meta_title' , '物业管理');
        return $this->fetch();
    }
    public function add(){
        is_login() || $this->error('您还没有登录，请先登录！', url('Login/index'));
        if(request()->isPost()){
            $Property = model('property');
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('property');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }

            $data = $Property->create($post_data);
            if($data){
                $this->success('报修成功', url('index'));
                //记录行为
                action_log('update_property', 'property', $data->id, UID);
            } else {
                $this->error($Property->getError());
            }
        } else {
            $pid = input('pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = \think\Db::name('Property')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }
            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->assign('meta_title', '新增报修');
            return $this->fetch('add');
        }
    }

//    public function edit($id = 0){
//
//        if($this->request->isPost()){
//            $postdata = \think\Request::instance()->post();
//            //自动验证
//            $validate = validate('property');
//            if(!$validate->check($postdata)){
//                return $this->error($validate->getError());
//            }
//            $Property = \think\Db::name("property");
//            $data = $Property->update($postdata);
//            if($data !== false){
//                $this->success('编辑成功', url('index'));
//            } else {
//                $this->error('编辑失败');
//            }
//        } else {
//            $info = array();
//            /* 获取数据 */
//            $info = \think\Db::name('Property')->find($id);
//
//            if(false === $info){
//                $this->error('获取配置信息错误');
//            }
//
//            $pid = input('get.pid', 0);
//            //获取父导航
//            if(!empty($pid)){
//                $parent = \think\Db::name('Property')->where(array('id'=>$pid))->field('title')->find();
//                $this->assign('parent', $parent);
//            }
//
//            $this->assign('pid', $pid);
//            $this->assign('info', $info);
//            $this->meta_title = '编辑报修';
//            return $this->fetch();
//        }
//    }
//
//    public function del(){
//        $id = array_unique((array)input('id/a',0));
//
//        if ( empty($id) ) {
//            $this->error('请选择要操作的数据!');
//        }
//
//        $map = array('id' => array('in', $id) );
//        if(\think\Db::name('property')->where($map)->delete()){
//            //记录行为
//            action_log('update_property', 'property', $id, UID);
//            $this->success('删除成功');
//        } else {
//            $this->error('删除失败！');
//        }
//    }
}