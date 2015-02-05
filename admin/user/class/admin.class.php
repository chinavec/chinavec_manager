<?php
/**
 * ����Ա����ɶԹ���Ա�Ļ�������
 * �����漰�����ݿ�Ĳ�����ʹ�ø���ʱӦ�������������ݿ�.
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
	
	//���캯��
	public function __construct($db){
		$this->db = $db;
	}
	
	//���ù���ԱID
	public function setAdminID($id){
		$this->adminID = $id;
		return $this->getInfoById($this->adminID);
	}
	//���ù���Ա�������ֵ
	public function setValue($values){
		foreach($values as $key => $item){
			$this->$key = $item;
		}
	}
	
	//��ȡ������ֵ�����ع�������
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
	
	//��������Ա
	public function create(){
		//������Ч���ж�
		$info = $this->dataValid();
		
		//���ݺϷ�
		if($info === true){
			//�жϹ���Ա�û����Ƿ��Ѿ�����
			if(count($this->db->select_condition('admin', array('username' => $this->username)))){
				return array('operation' => 0, 'info' => '�½�����Ա��Ϣʧ�ܣ��Ѵ��ڵ��û���');
			}else{
				//�û��������ظ�
				$row = array('username' => $this->username, 'real_name' => $this->real_name, 'password' => $this->password, 'contact' => $this->contact,'department' => $this->department,'position' => $this->position,'work_permit' => $this->work_permit,'admin_role_id' => $this->admin_role_id,'create_time' => strtotime('now'));
				
				if($this->db->insert('admin', $row)){
					return array('operation' => 1, 'info' => '�½�����Ա��Ϣ�ɹ�');
				}else{
					return array('operation' => 0, 'info' => '�½�����Ա��Ϣʧ�ܣ�����������������');
				}
			}			
		}else{
			return $info;
		}
	}
	
	//���¹���Ա��Ϣ
	public function update(){
		//����Ա���Ա༭
		
			$info = $this->dataValid();
			
			//���ݺϷ�
			if($info === true){
				//�жϹ���Ա�����Ƿ��Ѿ�����
				$result = $this->db->select_condition_one('admin', array('username' => $this->username));
				if($result && $result->id != $this->adminID){
					//���ظ�
					return array('operation' => 0, 'info' => '�༭����Ա��Ϣʧ�ܣ��Ѵ��ڵ��û���');
				}else{
					$row = array('username' => $this->username, 'real_name' => $this->real_name, 'password' => $this->password, 'contact' => $this->contact,'department' => $this->department,'position' => $this->position,'work_permit' => $this->work_permit,'admin_role_id' => $this->admin_role_id,'create_time' => strtotime('now'));
										
					if($this->db->update('admin', $row, array('id' => $this->adminID))){
						return array('operation' => 1, 'info' => '�༭����Ա��Ϣ�ɹ�');
					}else{
						return array('operation' => 0, 'info' => '�༭����Ա��Ϣʧ�ܣ�����������������');
					}
				}			
			}else{
				return $info;
			}
		}
	
	
	//ɾ������Ա��Ϣ
	public function delete(){
		if($this->db->delete('admin', array('id' => $this->adminID))){
			return array('operation' => 1, 'info' => '����Աɾ���ɹ�');
		}else{
			return array('operation' => 0, 'info' => '��������æ�����Ժ�����');
		}
	}
	
	
	//������Ч���ж�
	private function dataValid(){
		if($this->username == '' || mb_strlen($this->username, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '����Ա�û���Ϊ�ջ����20���ַ�');
		}else if($this->real_name == '' || mb_strlen($this->real_name, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '����Ա��ʵ����Ϊ�ջ����20���ַ�');
		}else if($this->password == '' || mb_strlen($this->password, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '����Ա����Ϊ�ջ����20���ַ�');
		}else if($this->contact == '' || mb_strlen($this->contact, 'UTF-8') > 20){
			return array('operation' => 0, 'info' => '����Ա��ϵ��ʽΪ�ջ����20���ַ�');
		}else{
			return true;
		}
	}
	//���ݹ���Աid��ѯ����Ա��Ϣ
	private function getInfoById($_id){
		//�ж��Ƿ���ڶ�Ӧ����id�Ĺ���Ա	
		$result = $this->db->select_condition_one('admin', array('id' => $_id));
		if(count($result)){
			//����Ա����
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
			return array('operation' => 1, 'info' => '�ɹ���ȡ����Ա��Ϣ����������');
		}else{
			return array('operation' => 0, 'info' => 'û���ҵ���Ӧ�Ĺ���Ա');
		}
	}
}
?>