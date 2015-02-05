<?php
/**
 * 业务类完成对业务的基本管理
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class AdminSelect
{
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//根据管理员用户名/角色查询管理员信息
	public function searchAdminByName($username, $offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `admin` WHERE `username` LIKE '%{$username}%' ";
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `admin`.`id`,`username`,`password`,`real_name`,`contact`,`department`,`position`,`work_permit`,`create_time`,`admin_role_id`,`name`
				FROM `admin` right join `admin_role` on `admin`.`admin_role_id` = `admin_role`.`id`
				WHERE `username` LIKE '%{$username}%' or `name` LIKE '%{$username}%' ";
				//echo $sql;
		//$sql = "select `admin`.* ,`admin_role`.`id` as `adminRoleId` ,`admin_role`.`name` as `adminRoleName` from `admin` right join `admin_role` on `admin`.`admin_role_id` = `admin_role`.`id` LIMIT $offset, $pageSize";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}
    //管理员列表，按创建时间倒叙
	public function adminLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `admin` ";
		
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `admin`.`id`,`username`,`password`,`real_name`,`contact`,`create_time`,`department`,`position`,`work_permit`,`admin_role_id`,`name`FROM `admin` right join `admin_role` on `admin`.`admin_role_id` = `admin_role`.`id`ORDER BY `create_time` DESC";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}	
	
	
}
?>