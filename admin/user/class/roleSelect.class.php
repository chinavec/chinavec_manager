<?php
/**
 * 业务类完成对业务的基本管理
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class RoleSelect
{
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//根据用户名称查询用户信息
	public function searchRoleByName($name, $offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user_role` WHERE `name` LIKE '%{$name}%' ";
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `user_role_right`.`id`,`user_role_id`,`user_right_id`
				FROM `user_role_right` right join `user_role` on `user_role_right`.`user_role_id` = `user_role`.`id`
				WHERE `name` LIKE '%{$name}%' ";
				//echo $sql;
		//$sql = "select `admin`.* ,`user_role`.`id` as `adminRoleId` ,`user_role`.`name` as `adminRoleName` from `admin` right join `user_role` on `admin`.`user_role_id` = `user_role`.`id` LIMIT $offset, $pageSize";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}
//业务列表，按创建时间倒叙
	public function roleLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user_role` ";
		
		$result['total'] = $this->db->count($sql);
		
		/*$sql = "SELECT `user_role_right`.`id`,`user_role_id`,`user_right_id`
				FROM `user_role_right` right join `user_role` on `user_role_right`.`user_role_id` = `user_role`.`id`
				ORDER BY `id` DESC";
		*/
		$sql = "SELECT `user_role_right`.`id`,`user_role_id`,GROUP_CONCAT(`user_right_id` SEPARATOR '/') as `user_right_id`,`user_role`.*
				FROM `user_role_right` right join `user_role` on `user_role_right`.`user_role_id` = `user_role`.`id`
				 group by `name` ORDER BY `user_role_right`.`id`";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}	
	
	
}
?>
