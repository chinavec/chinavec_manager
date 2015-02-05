<?php
/**
 * 业务类完成对业务的基本管理
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class RightSelect
{
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//根据用户名称查询用户信息
	public function searchRightByName($name, $offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user_right` WHERE `name` LIKE '%{$name}%' ";
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `user_right_right`.`id`,`user_right_id`,`user_right_id`
				FROM `user_right_right` right join `user_right` on `user_right_right`.`user_right_id` = `user_right`.`id`
				WHERE `name` LIKE '%{$name}%' ";
				//echo $sql;
		//$sql = "select `admin`.* ,`user_right`.`id` as `adminRoleId` ,`user_right`.`name` as `adminRoleName` from `admin` right join `user_right` on `admin`.`user_right_id` = `user_right`.`id` LIMIT $offset, $pageSize";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}
//业务列表，按创建时间倒叙
	public function rightLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user_right` ";
		
		$result['total'] = $this->db->count($sql);
		
		/*$sql = "SELECT `user_right_right`.`id`,`user_right_id`,`user_right_id`
				FROM `user_right_right` right join `user_right` on `user_right_right`.`user_right_id` = `user_right`.`id`
				ORDER BY `id` DESC";
		*/
		/*
		$sql = "SELECT `user_right_right`.`id`,`user_right_id`,GROUP_CONCAT(`user_right_id` SEPARATOR '/') as `user_right_id`,`user_right`.*
				FROM `user_right_right` right join `user_right` on `user_right_right`.`user_right_id` = `user_right`.`id`
				 group by `name` ORDER BY `user_right_right`.`id` DESC";
		*/
		$sql = "SELECT * FROM `user_right` ORDER BY `id` DESC";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}	
	
	
}
?>