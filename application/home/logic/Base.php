<?php
namespace app\home\logic;
use think\Model;

/**
 * 文档模型逻辑层公共模型
 * 所有逻辑层模型都需要继承此模型
 */
class Base extends Model{

	protected $autoWriteTimestamp = false;
    protected $FormData; //接收表单数据

    public function __construct($name=''){
        if(!empty($name) && !empty($name['twothink_name']) && count($name) == 1){
            $this->name=$name['twothink_name'];
            parent::__construct();
        }else{
            parent::__construct($name);
        }
    }
    public function initialize(){
        $data = Request::instance()->param();
        if(empty($data['id']))
            unset($data['id']);
        $this->FormData = $data;
        parent::initialize();
    }

	/**
	 * 获取模型详细信息
	 * @param  integer $id 文档ID
	 * @return array       当前模型详细信息
	 */
	public function detail($id){
		$data = db($this->name)->field(true)->find($id);
		if(!$data){
			$this->error = '获取详细信息出错！';
			return false;
		}
		return $data;
	}

	/**
	 * 获取段落列表
	 * @param  array $ids 要获取的段落ID列表
	 * @return array      段落数据列表
	 */
	public function lists($ids){
		$map = array();
		if(1 === count($ids)){
			$map['id'] = $ids[0];
		} else {
			$map['id'] = array('in', $ids);
		}

		$data = db($this->name)->field(true)->where($map)->select();
		$list = array();
		foreach ($data as $value) {
			$list[$value['id']] = $value;
		}
		return $list;
	}

    /**
     * 新增或添加模型数据
     * @param  number $id 文章ID
     * @return boolean    true-操作成功，false-操作失败
     */
    public function updates($id =0) { 
        /* 获取数据 */
        $data = input();
        if (empty($data['id'])) {//新增数据
        	$data['id'] = $id;
        	$id = $this->data($data)->allowField(true)->save();
        	if (!$id) {
        		$this->error = '新增数据失败！';
        		return false;
        	}
        } else { //更新数据
        	$id = $data['id'];
        	$status = $this->data($data,true)->allowField(true)->save($data,['id'=>$id]);
        	if (false === $status) {
        		$this->error = '更新数据失败！';
        		return false;
        	}
        }
        return true;
    }
}
