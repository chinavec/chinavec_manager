<?php
/**
 * 权限类完成对权限的基本操作
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class Right
{
	private $rightID;
	private $name;
	private $user_right_id;
	private $access;
	
	public $access_array;		//数组access[]
	private $db;
	public $RightID;			//Update更新的id
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//设置权限ID
	public function setRightID($id){
		$this->rightID = $id;
		return $this->getInfoById($this->rightID);
	}
	//设置权限类各属性值
	public function setValue($values){
		foreach($values as $key => $item){
			$this->$key = $item;
		}
	}
	
	public function setValueaccess($values){
		foreach($values as $key => $item){
			$this->$key = $item;
		}
		$this->access_array = $values;
	}
	
	//获取各属性值，返回关联数组
	public function getrightInfo(){
		$c['rightID'] = $this->rightID;
		$c['name'] = $this->name;
		$c['user_right_id'] = $this->user_right_id;
		$c['access'] = $this->access;
	  
		return $c;
	}
	
	//创建权限
	public function create(){
		//数据有效性判断
		$info = $this->dataValid();
		
		//数据合法
		if($info === true){
			//判断权限名是否已经存在
			if(count($this->db->select_condition('user_right', array('name' => $this->name)))){
				return array('operation' => 0, 'info' => '新建权限信息失败，已存在的权限名');
			}else{
				//权限名不重复
				$row = array('name' => $this->name);
				
				//$row_access= $this->access_array;
				
				
				if($this->db->insert('user_right', $row)){
					
					$last_insert_id=$this->db->last_insert_id();
					
					//for($i=0;$i<count($row_access);$i++){
						
					//	$array=array("user_right_id"=>$last_insert_id,"user_right_id"=>$row_access[$i]);
						
					//	$this->db->insert('user_right_right', $array);
						
					//}
					
					return array('operation' => 1, 'info' => '新建权限信息成功');
					
				}else{
					return array('operation' => 0, 'info' => '新建权限信息失败，服务器错误，请重试');
				}
			}			
		}else{
			return $info;
		}
	}
	
	//更新权限信息
	public function update(){
		//权限可以编辑
		
			$info = $this->dataValid();
			
			//数据合法
			if($info === true){
				//判断权限名称是否已经存在
				$result = $this->db->select_condition_one('user_right', array('name' => $this->name));
				if($result && $result->id != $this->RightID){
					//名重复
					return array('operation' => 0, 'info' => '编辑权限信息失败，已存在的权限名');
				}else{
					$row = array('name' => $this->name);
					//$row_access= $this->access_array;
										
					if($this->db->update('user_right', $row, array('id' => $this->RightID))){
						/*
						$this->db->delete('user_right_right',array('user_right_id' => $this->RightID));
						
						for($i=0;$i<count($row_access);$i++){
						
						//$array=array("user_right_id"=>$this->RightID,"access"=>$row_access[$i]);
						
						//$this->db->update('admin_access', $array, array('id' => $this->RightID));
						
						$array=array("user_right_id"=>$this->RightID,"user_right_id"=>$row_access[$i]);
						
						$this->db->insert('user_right_right', $array);
						
						}
						*/
						return array('operation' => 1, 'info' => '编辑权限信息成功');
					}else{
						return array('operation' => 0, 'info' => '编辑权限信息失败，服务器错误，请重试');
					}
				}			
			}else{
				return $info;
			}
		}
	
	
	//删除权限信息
	public function delete(){
		if($this->db->delete('user_right', array('id' => $this->rightID))){
			return array('operation' => 1, 'info' => '权限删除成功');
		}else{
			return array('operation' => 0, 'info' => '服务器繁忙，请稍后重试');
		}
	}
	
	
	//数据有效性判断
	private function dataValid(){
		if($this->name == '' || mb_strlen($this->name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '权限用户名为空或大于20个字符');
		}else{
			return true;
		}
	}
		//根据权限id查询权限信息
	private function getInfoById($_id){
		//判断是否存在对应传入id的权限	
		$result = $this->db->select_condition_one('user_right', array('id' => $_id));
		if(count($result)){
			//权限存在
			$c['rightID'] = $result->id;
			$c['name'] = $result->name;
			
			$this->setValue($c);
			return array('operation' => 1, 'info' => '成功获取权限信息并设置属性');
		}else{
			return array('operation' => 0, 'info' => '没有找到对应的权限');
		}
	}
}
?>