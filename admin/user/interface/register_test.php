<?php
	//require('../../../config/config.php');
	//require('../../../lib/http_client.class.php');

	$interfaceAddress = 'http://localhost/cloudm/admin/usermanage/register.php';
	//$interfaceAddress = 'http://' . $config['paymentServer']  .'/admin/user/interface/register.php';
	//echo $interfaceAddress;
    $params = array(
	    'username'=>'张三',
        'password1'  => '111111',
        'password2'  => '111111',
        'email'     => 'email',
        'unit'      => 'unit',
        'real_name' => 'realName',
        'nick_name' => 'nickName',
        'gender'    => 1,
        'address'   => 'address',
        'contact'   => 'contact',
        //其余参数拼接
    );
    $postFields = http_build_query($params);
    //print_r ($postFields);
    $ch = curl_init();									// 初始化CURL句柄
    curl_setopt($ch, CURLOPT_URL, $interfaceAddress);				//设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		// 设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_POST, 1);					//启用POST提交
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);	//设置POST提交的字符串
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);			// 超时时间
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0');	//HTTP请求User-Agent:头
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept-Language: zh-cn',
        'Connection: Keep-Alive',
        'Cache-Control: no-cache'
    )); //设置HTTP头信息
    $data		= curl_exec($ch);							//执行预定义的CURL
//		$info		= curl_getinfo($ch);						//得到返回信息的特性
//    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    
    
    var_dump(json_decode($data,true));
?>