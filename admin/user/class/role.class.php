<?php
/**
 * 角色类完成对角色的基本操作
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class Role
{
	private $roleID;
	private $name;
	private $user_role_id;
	private $access;
	
	public $access_array;		//数组access[]
	private $db;
	public $RoleID;			//Update更新的id
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//设置角色ID
	public function setRoleID($id){
		$this->roleID = $id;
		return $this->getInfoById($this->roleID);
	}
	//设置角色类各属性值
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
	public function getroleInfo(){
		$c['roleID'] = $this->roleID;
		$c['name'] = $this->name;
		$c['user_role_id'] = $this->user_role_id;
		$c['access'] = $this->access;
	  
		return $c;
	}
	
	//创建角色
	public function create(){
		//数据有效性判断
		$info = $this->dataValid();
		
		//数据合法
		if($info === true){
			//判断角色用户名是否已经存在
			if(count($this->db->select_condition('user_role', array('name' => $this->name)))){
				return array('operation' => 0, 'info' => '新建角色信息失败，已存在的用户名');
			}else{
				//用户名名不重复
				$row = array('name' => $this->name);
				
				$row_access= $this->access_array;
				
				
				if($this->db->insert('user_role', $row)){
					
					$last_insert_id=$this->db->last_insert_id();
					
					for($i=0;$i<count($row_access);$i++){
						
						$array=array("user_role_id"=>$last_insert_id,"user_right_id"=>$row_access[$i]);
						
						$this->db->insert('user_role_right', $array);
						
					}
					
					return array('operation' => 1, 'info' => '新建角色信息成功');
					
				}else{
					return array('operation' => 0, 'info' => '新建角色信息失败，服务器错误，请重试');
				}
			}			
		}else{
			return $info;
		}
	}
	
	//更新角色信息
	public function update(){
		//角色可以编辑
		
			$info = $this->dataValid();
			
			//数据合法
			if($info === true){
				//判断角色名称是否已经存在
				$result = $this->db->select_condition_one('user_role', array('name' => $this->name));
				if($result && $result->id != $this->RoleID){
					//名重复
					return array('operation' => 0, 'info' => '编辑角色信息失败，已存在的角色名');
				}else{
					$row = array('name' => $this->name);
					$row_access= $this->access_array;
										
					if($this->db->update('user_role', $row, array('id' => $this->RoleID))){
						
						$this->db->delete('user_role_right',array('user_role_id' => $this->RoleID));
						
						for($i=0;$i<count($row_access);$i++){
						
						//$array=array("user_role_id"=>$this->RoleID,"access"=>$row_access[$i]);
						
						//$this->db->update('admin_access', $array, array('id' => $this->RoleID));
						
						$array=array("user_role_id"=>$this->RoleID,"user_right_id"=>$row_access[$i]);
						
						$this->db->insert('user_role_right', $array);
						
						}
						return array('operation' => 1, 'info' => '编辑角色信息成功');
					}else{
						return array('operation' => 0, 'info' => '编辑角色信息失败，服务器错误，请重试');
					}
				}			
			}else{
				return $info;
			}
		}
	
	
	//删除角色信息
	public function delete(){
		if($this->db->delete('user_role', array('id' => $this->roleID))){
			return array('operation' => 1, 'info' => '角色删除成功');
		}else{
			return array('operation' => 0, 'info' => '服务器繁忙，请稍后重试');
		}
	}
	
	
	//数据有效性判断
	private function dataValid(){
		if($this->name == '' || mb_strlen($this->name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '角色用户名为空或大于20个字符');
		}else{
			return true;
		}
	}
		//根据角色id查询角色信息
	private function getInfoById($_id){
		//判断是否存在对应传入id的角色	
		$result = $this->db->select_condition_one('user_role', array('id' => $_id));
		if(count($result)){
			//角色存在
			$c['roleID'] = $result->id;
			$c['name'] = $result->name;
			
			$this->setValue($c);
			return array('operation' => 1, 'info' => '成功获取角色信息并设置属性');
		}else{
			return array('operation' => 0, 'info' => '没有找到对应的角色');
		}
	}
}
?>