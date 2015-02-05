<?php
/**
 * 业务类完成对权限的基本管理
 * 该类涉及到数据库的操作，使用该类时应该先行连接数据库.
 */
 
class AuthoritySelect
{
	private $db;
	
	//构造函数
	public function __construct($db){
		$this->db = $db;
	}
	
	//根据管理员名称查询管理员信息
	public function searchRoleByName($name, $offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `admin_role` WHERE `name` LIKE '%{$name}%' ";
		$result['total'] = $this->db->count($sql);
		
		$sql = "SELECT `admin_access`.`id`,`admin_role_id`,`access`
				FROM `admin_access` right join `admin_role` on `admin_access`.`admin_role_id` = `admin_role`.`id`
				WHERE `name` LIKE '%{$name}%' ";
				//echo $sql;
		//$sql = "select `admin`.* ,`admin_role`.`id` as `adminRoleId` ,`admin_role`.`name` as `adminRoleName` from `admin` right join `admin_role` on `admin`.`admin_role_id` = `admin_role`.`id` LIMIT $offset, $pageSize";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}
//业务列表，按创建时间倒叙
	public function authorityLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `admin_authority` ";
		
		$result['total'] = $this->db->count($sql);
		
		/*$sql = "SELECT `admin_access`.`id`,`admin_role_id`,`access`
				FROM `admin_access` right join `admin_role` on `admin_access`.`admin_role_id` = `admin_role`.`id`
				ORDER BY `id` DESC";
		
		$sql = "SELECT `admin_access`.`id`,`admin_role_id`,GROUP_CONCAT(`access` SEPARATOR '/') as `access`,`admin_role`.*
				FROM `admin_access` right join `admin_role` on `admin_access`.`admin_role_id` = `admin_role`.`id`
				 group by `name` ORDER BY `admin_access`.`id` DESC";
		*/
		$sql = "SELECT *
				FROM `admin_authority` where `id`='".$id."';";
		if($len > 0){
			$sql .= " LIMIT $offset,$len";
		}
		$result['list'] = $this->db->select($sql);
		return $result;
	}	
	
	
}
?>