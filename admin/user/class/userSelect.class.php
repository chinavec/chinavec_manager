<?php
/**
 * ҵ������ɶ�ҵ��Ļ�������
 * �����漰�����ݿ�Ĳ�����ʹ�ø���ʱӦ�������������ݿ�.
 */
 
class UserSelect
{
	private $db;
	
	//���캯��
	public function __construct($db){
		$this->db = $db;
	}
	
	//���ݹ���Ա���Ʋ�ѯ����Ա��Ϣ
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
//�û��б�������ʱ�䵹��
	public function userLists($offset=0, $len=0){
		
		$sql = "SELECT COUNT(`id`) FROM `user` ";
		
		$result['total'] = $this->db->count($sql);
		/*
		$sql = "SELECT `id`,`name`,`password`,`email`,`real_name`,`gender`,`address`,`mp`,`create_time`,`log_off`,`login_time`
				FROM `user` 
				ORDER BY `create_time` DESC";
		*/
		//select * from T1 inner join T2 on T1.userid=T2.userid	����
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