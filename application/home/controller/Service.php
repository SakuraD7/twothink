<?php
/**
 * Created by PhpStorm.
 * User: 学思
 * Date: 2018/11/12
 * Time: 11:52
 */

namespace app\home\controller;

use app\home\model\Document;

class Service extends Home {
    public function index(){
        $category = model('Category')->getTree();
        $document = new Document();
        $lists    = $document->lists(null);
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',model('Document')->page);//分页
        return $this->fetch();
    }
    /* 文档模型详情页 */
    public function detail($id = 0, $p = 44){
        /* 标识正确性检测 */
        if(!($id && is_numeric($id))){
            $this->error('文档ID错误！');
        }
        /* 页码检测 */
        $p = intval($p);
        $p = empty($p) ? 44 : $p;

        /* 获取详细信息 */
        $Document = new Document();
        $info = $Document->detail($id);
        if(!$info){
            $this->error($Document->getError());
        }
        /* 更新浏览数 */
        $map = array('id' => $id);
        $Document->where($map)->setInc('view');
        /* 模板赋值并渲染模板 */
        $this->assign('info', $info);
        $this->assign('page', $p); //页码
        return $this->fetch("service");
    }
}