<?php
/*
 *�����û���ͳ�ƹ���
 *Ф�Ǵ�
 *V1.0
 *2013-4-17
 */

	require('../../../lib/http_client.class.php');
	require('../../../lib/db.class.php');
	require('../../../lib/log.php');
	
	//��ȡ��ǰʱ��
	$strtime = date('Y-m-d');
	//��ʱ������ָ�������
	$timearray = explode("-",$strtime);
	$year = $timearray[0];
	$month = $timearray[1];
	$day = $timearray[2];
	
	//ʵ�������ݿ������
	$db = new DB();
	//����
	//$sql = "select count(*) from `site_visit_record` where `visit_time` >= ".$strtime;//`visit_time`���ڵ��ڵ����賿��ʱ�䣬�������ʱ��
	
	//��user���ݱ��е�login_time�жϵ���ʱ��ĵ�¼�û���
	$sql = "select count(*) from `user` where `login_time` >= ".$strtime;//`login_time`���ڵ��ڵ����賿��ʱ�䣬�������ʱ��
	$userData = $db->count($sql, $sqlOracle='');
	
	//ͳ�Ƶ����û����ݴ���user_statistics���ݱ�	
	//���ô洢���ݿ��еĲ���
	$row = array('user_total' => $userData, 'year' => $year, 'month' => $month, 'day' => $day);
	//�������ݿ��������insert����ʵ�д洢���ݲ��������ɹ�����"OK"��Ϣ��ʧ�ܷ���"ERROR"��Ϣ
	if($db->insert('user_statistics', $row)){
		echo "OK";
	}else{
		echo "ERROR";
		//������־����������־
		systemLog('�����û���ͳ��ʧ��', 1, 5, $db);
	}
	//�ر����ݿ�
	$db->close();
 ?>