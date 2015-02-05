<?php
/**
 * 业务类完成对业务的基本管理
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class UserSelect
{
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//根据管理员名称查询管理员信息
	public function searchUserByName($username, $offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user` WHERE `username` LIKE '%{$username}%' ";
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `id`,`name`,`password`,`email`,`real_name`,`gender`,`address`,`mp`,`create_time`,`log_off`,`login_time`
				FROM `user` 
				WHERE `username` LIKE '%{$username}%' ";
		/*
		$sql = "SELECT `id`,`username`,`password`,`email`,`real_name`,`nick_name`,`gender`,`address`,`contact`,`create_time`,`log_off`,`token`,`login_time`
				FROM `user` 
				WHERE `username` LIKE '%{$username}%' ";
		*/
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}
//用户列表，按创建时间倒叙
	public function userLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user` ";
		
		$result['total'] = $this->db->count($sql);
		/*
		$sql = "SELECT `id`,`name`,`password`,`email`,`real_name`,`gender`,`address`,`mp`,`create_time`,`log_off`,`login_time`
				FROM `user` 
				ORDER BY `create_time` DESC";
		*/
		//select * from T1 inner join T2 on T1.userid=T2.userid	例子
		$sql = "SELECT `user`.`id`,`user`.`name` as `user_name`,`user_role_id`,`gender`,`points`,`mp`,`email`,`real_name`,`address`,`create_time`,`user_role`.`name` as `role_name`  
				from `user` left join `user_role` on `user`.`user_role_id` = `user_role`.`id` 
				ORDER BY `create_time` DESC";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}	
	
	
}
?>