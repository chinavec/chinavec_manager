<?php
/**
 * 管理员类完成对管理员的基本操作
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class Admin
{
	private $adminID;
	private $username;
	private $real_name;
	private $password;
	private $admin_role_id;
	private $contact;
	private $department;
	private $position;
	private $work_permit;
	private $create_time;
		
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//设置管理员ID
	public function setAdminID($id){
		$this->adminID = $id;
		return $this->getInfoById($this->adminID);
	}
	//设置管理员类各属性值
	public function setValue($values){
		foreach($values as $key => $item){
			$this->$key = $item;
		}
	}
	
	//获取各属性值，返回关联数组
	public function getAdminInfo(){
		$c['adminID'] = $this->adminID;
		$c['username'] = $this->username;
		$c['real_name'] = $this->real_name;
		$c['password'] = $this->password;
		$c['admin_role_id'] = $this->admin_role_id;
		$c['contact'] = $this->contact;
		$c['department'] = $this->department;
		$c['position'] = $this->position;
		$c['work_permit'] = $this->work_permit;
		$c['create_time'] = $this->create_time;
	  
		return $c;
	}
	
	//创建管理员
	public function create(){
		//数据有效性判断
		$info = $this->dataValid();
		
		//数据合法
		if($info === true){
			//判断管理员用户名是否已经存在
			if(count($this->db->select_condition('admin', array('username' => $this->username)))){
				return array('operation' => 0, 'info' => '新建管理员信息失败，已存在的用户名');
			}else{
				//用户名名不重复
				$row = array('username' => $this->username, 'real_name' => $this->real_name, 'password' => $this->password, 'contact' => $this->contact,'department' => $this->department,'position' => $this->position,'work_permit' => $this->work_permit,'admin_role_id' => $this->admin_role_id,'create_time' => strtotime('now'));
				
				if($this->db->insert('admin', $row)){
					return array('operation' => 1, 'info' => '新建管理员信息成功');
				}else{
					return array('operation' => 0, 'info' => '新建管理员信息失败，服务器错误，请重试');
				}
			}			
		}else{
			return $info;
		}
	}
	
	//更新管理员信息
	public function update(){
		//管理员可以编辑
		
			$info = $this->dataValid();
			
			//数据合法
			if($info === true){
				//判断管理员名称是否已经存在
				$result = $this->db->select_condition_one('admin', array('username' => $this->username));
				if($result && $result->id != $this->adminID){
					//名重复
					return array('operation' => 0, 'info' => '编辑管理员信息失败，已存在的用户名');
				}else{
					$row = array('username' => $this->username, 'real_name' => $this->real_name, 'password' => $this->password, 'contact' => $this->contact,'department' => $this->department,'position' => $this->position,'work_permit' => $this->work_permit,'admin_role_id' => $this->admin_role_id,'create_time' => strtotime('now'));
										
					if($this->db->update('admin', $row, array('id' => $this->adminID))){
						return array('operation' => 1, 'info' => '编辑管理员信息成功');
					}else{
						return array('operation' => 0, 'info' => '编辑管理员信息失败，服务器错误，请重试');
					}
				}			
			}else{
				return $info;
			}
		}
	
	
	//删除管理员信息
	public function delete(){
		if($this->db->delete('admin', array('id' => $this->adminID))){
			return array('operation' => 1, 'info' => '管理员删除成功');
		}else{
			return array('operation' => 0, 'info' => '服务器繁忙，请稍后重试');
		}
	}
	
	
	//数据有效性判断
	private function dataValid(){
		if($this->username == '' || mb_strlen($this->username, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '管理员用户名为空或大于20个字符');
		}else if($this->real_name == '' || mb_strlen($this->real_name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '管理员真实姓名为空或大于20个字符');
		}else if($this->password == '' || mb_strlen($this->password, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '管理员密码为空或大于20个字符');
		}else if($this->contact == '' || mb_strlen($this->contact, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '管理员联系方式为空或大于20个字符');
		}else{
			return true;
		}
	}
	//根据管理员id查询管理员信息
	private function getInfoById($_id){
		//判断是否存在对应传入id的管理员	
		$result = $this->db->select_condition_one('admin', array('id' => $_id));
		if(count($result)){
			//管理员存在
			$c['adminID'] = $result->id;
			$c['username'] = $result->username;
			$c['real_name'] = $result->real_name;
			$c['password'] = $result->password;
			$c['contact'] = $result->contact;
			$c['department'] = $this->department;
			$c['position'] = $this->position;
			$c['work_permit'] = $this->work_permit;
			$c['admin_role_id'] = $result->admin_role_id;
			$c['create_time'] = $result->create_time;
			$now = strtotime('now');
			
			$this->setValue($c);
			return array('operation' => 1, 'info' => '成功获取管理员信息并设置属性');
		}else{
			return array('operation' => 0, 'info' => '没有找到对应的管理员');
		}
	}
}
?>