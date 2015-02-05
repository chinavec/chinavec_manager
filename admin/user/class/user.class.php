<?php
/**
 * 用户类完成对用户的基本操作
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class User
{
	private $userID;
	private $name;
	private $user_role_id;
	private $password;
	private $email;	
	private $real_name;
	//private $nick_name;
	private $gender;
	private $address;
	private $mp;
	private $create_time;
	private $log_off;
	//private $token;
	private $login_time;
	
	public $access_array;		//数组access[]
	
		
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//设置用户ID
	public function setUserID($id){
		$this->userID = $id;
		return $this->getInfoById($this->userID);
	}
	//设置用户类各属性值
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
	public function getUserInfo(){
		$c['userID'] = $this->userID;
		$c['name'] = $this->name;
		$c['user_role_id'] = $this->user_role_id;
		$c['password'] = $this->password;
		$c['real_name'] = $this->real_name;
		$c['mp'] = $this->mp;
		//$c['nick_name'] = $this->nick_name;
		$c['address'] = $this->address;
		$c['create_time'] = $this->create_time;
		$c['email'] = $this->email;
		$c['gender'] = $this->gender;
		$c['log_off'] = $this->log_off;
		//$c['token'] = $this->token;
		$c['login_time'] = $this->login_time;
	  
		return $c;
	}
	
	//创建用户
	public function create(){
		//数据有效性判断
		$info = $this->dataValid();
		
		//数据合法
		if($info === true){
			//判断用户名是否已经存在
			if(count($this->db->select_condition('user', array('name' => $this->name)))){
				return array('operation' => 0, 'info' => '新建用户信息失败，已存在的用户名');
			}else{
				//用户名名不重复
				$row_access= $this->access_array;
				$row = array('name' => $this->name, 'user_role_id' => $row_access[0],'password' => $this->password,'real_name' => $this->real_name,  'mp' => $this->mp,'address' => $this->address,'create_time' => strtotime('now'),'email' => $this->email,'gender' => $this->gender,'create_time' => strtotime('now') ,'log_off' => $this->log_off);
				
				
				if($this->db->insert('user', $row)){
					return array('operation' => 1, 'info' => '新建用户信息成功');
				}else{
					return array('operation' => 0, 'info' => '新建用户信息失败，服务器错误，请重试');
				}
			}			
		}else{
			return $info;
		}
	}
	
	//更新用户信息
	public function update(){
		//用户可以编辑
		
			//数据有效性判断
			$info = $this->dataValid();
			
			//数据合法
			if($info === true){
				//判断用户名称是否已经存在
				$result = $this->db->select_condition_one('user', array('name' => $this->name));
				if($result && $result->id != $this->userID){
					//名重复
					return array('operation' => 0, 'info' => '编辑用户信息失败，已存在的用户名');
				}else{
					$row = array('name' => $this->name, 'user_role_id' => $this->access_array[0],'password' => $this->password,'real_name' => $this->real_name,  'mp' => $this->mp,'address' => $this->address,'create_time' => strtotime('now'),'email' => $this->email,'gender' => $this->gender,'log_off' => $this->log_off);
										
					if($this->db->update('user', $row, array('id' => $this->userID))){
						return array('operation' => 1, 'info' => '编辑用户信息成功');
					}else{
						return array('operation' => 0, 'info' => '编辑用户信息失败，服务器错误，请重试');
					}
				}			
			}else{
				return $info;
			}
		
	}
	
	//删除用户信息
	public function delete(){
		
	
			if($this->db->delete('user', array('id' => $this->userID))){
					return array('operation' => 1, 'info' => '用户信息删除成功');
				}else{
					return array('operation' => 0, 'info' => '服务器繁忙，请稍后重试');
				}
			
		
	}
	
	
	//数据有效性判断
	private function dataValid(){
		if($this->name == '' || mb_strlen($this->name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '用户名为空或大于20个字符');
		}
		//else if($this->password == '' || mb_strlen($this->password, 'UTF-8') > 20){
		//	return array('operation' => 0, 'info' => '用户密码为空或大于20个字符');
		//}
		else if($this->real_name == '' || mb_strlen($this->real_name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '用户真实姓名为空或大于20个字符');
		}else if($this->mp == '' || mb_strlen($this->mp, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '用户联系方式为空或大于20个字符');
		}else if($this->email == '' || mb_strlen($this->email, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '用户邮箱为空或大于20个字符');
		}else{
			return true;
		}
	}
	//根据业务id查询业务信息
	private function getInfoById($_id){
		//判断是否存在对应传入id的业务	
		$result = $this->db->select_condition_one('user', array('id' => $_id));
		if(count($result)){
			//业务存在
			$c['userID'] = $result->id;
			$c['name'] = $result->name;
			$c['user_role_id'] = $result->user_role_id;
			$c['password'] = $result->password;
			$c['real_name'] = $result->real_name;
			$c['mp'] = $result->mp;
			//$c['nick_name'] = $result->nick_name;
			$c['address'] = $result->address;
			$c['create_time'] = $result->create_time;
			$c['email'] = $result->email;
			$c['gender'] = $result->gender;
			$c['log_off'] = $result->log_off;
			$now = strtotime('now');
			
			$this->setValue($c);
			return array('operation' => 1, 'info' => '成功获取用户信息并设置属性');
		}else{
			return array('operation' => 0, 'info' => '没有找到对应的用户员');
		}
	}
}
?>