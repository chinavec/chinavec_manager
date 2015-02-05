<?php
	/*
	 *业务运营报表功能界面
	 *肖亚翠
	 *V1.0
	 *2013-5-10
	 */

	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('../../lib/util.class.php');
	require('class/businessStatistics.class.php');
	
	//是否设置日期，若设置则直接获取，若为设置则设置当天日期
	$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
	$month = isset($_GET['month']) ? $_GET['month'] : date('n');
	//设置当前文件路径变量
	$from = $config['root']."admin/support/businessStatistics.php";
	//实例化生成页码类
	$u = new Util();
	//判断日期的有效性
	if($u->validID($year) && $u->validID($month)){
		$year = intval($year);
		$month = intval($month);
		//值的初始化
		$totalOrder = 0;
		$totalIncome = 0;
		//年和月的有效范围
		if($year >= $dataAnalysisConfig['dataAnalysisStartYear'] && $year <= intval(date('Y')) && $month >= 1 && $month <= 12){
			$orderByDay = array();
			$incomeByDay = array();
			$days = array(31,29,31,30,31,30,31,31,30,31,30,31);
			//判断是否为瑞年
			if($u->isleap($year)){
				$days[1] = 28;
			}
			//值初始化
			for($i = 0; $i < $days[$month-1]; $i++){
				$orderByDay[$i] = 0;
				$incomeByDay[$i] = 0;
			}
			
			//实例化数据库操作类
			$db = new DB();
			$bs = new BusinessStatistics($db);
			//调用BusinessStatistics类文件中getAllDataByDay函数
			$result = $bs->getAllDataByDay($year, $month);
			//循环读取每月中每天的情况
			foreach($result as $item){
				$orderByDay[$item->day - 1] = $item->order_times;
				$incomeByDay[$item->day - 1] = $item->income;
				$totalOrder += $item->order_times;
				$totalIncome += $item->income;
			}
		}else{
				//跳转到错误信息页面
				$errorURL =  "../../common/error.php?error=".urlencode('没有该月的业务运营统计信息')."&back=".urlencode($from);
				header("Location: " . $errorURL);
				exit();
		}
	}else{
			//跳转到错误信息页面
			$errorURL =  "../../common/error.php?error=".urlencode('没有该月的业务运营统计信息')."&back=".urlencode($from);
			header("Location: " . $errorURL);
			exit();
	}
	//关闭数据库
	$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>业务运营统计--云媒体管理中心</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<link href="../../css/common_fang.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="css/businessStatistics.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/businessStatistics.js"></script>
<script type="text/javascript">
	var orderByDay = <?php echo json_encode($orderByDay); ?>;
	var incomeByDay = <?php echo json_encode($incomeByDay); ?>;
	
	var startYear = <?php echo $dataAnalysisConfig['dataAnalysisStartYear']; ?>;
	var startMonth = <?php echo $dataAnalysisConfig['dataAnalysisStartMonth']; ?>;
</script>
<style>
	#container_left ul li.businessStatistics{background-color:#108dbd;}
	#container_left ul li.businessStatistics a{color:#FFF;}
</style>
<script type="text/javascript">
	$(function(){
			$("<img src='../../img/lbg.gif'></img>").appendTo("#container_left ul li.business-statistics");
		});
</script>
</head>

<body>
	<?php include('../../common/admin_header.php'); ?>
    
    <div id="container" class="clearfix">
    	<div id="container_left" class="left">
			<?php include("common/leftMenu.html"); ?>
        </div>
        <div id="container_right" class="right">
            <h1 class="mytitle" id="title">运营统计</h1>
            <div class="selTittle">
            	<span>选择月份：</span>
            	<select id="selectMonth">
                </select>
            </div>
            <div><h2 class="tabStatis">业务：点播</h2></div>
        	<div style="border-bottom: 1px dashed #333;padding-bottom:10px;">
                <h3 class="caption"><?php echo $year . '年' . $month . '月用户订购业务数统计' ;?></h3>
                <img id="order" />
                <p class="totalFee">总计<?php echo $totalOrder; ?>订购数</p>
                <a class="detailButton" href="#" style="margin:10px;display:inline-block">显示详细信息</a>
                <table id="orderDetail" class="mytable none" style="width:80%;margin-left:10%;marin-top:10px">
                	<thead>
                    	<tr>
                        	<th width="20%">日期</th>
                        	<th width="20%">订购数</th>
                        	<th width="60%">比例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orderByDay as $key => $item): ?>
                    	<tr>
                        	<td><?php echo $key + 1; ?></td>
                        	<td><?php echo $item; ?></td>
                        	<td><div class="proportion"></div></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        	<div style="border-bottom: 1px dashed #333;padding-bottom:10px;margin-top:10px">
                <h3 class="caption"><?php echo $year . '年' . $month . '月业务收益金额（元）统计' ;?></h3>
                <img id="income" />
                <p class="totalFee">总计<?php echo $totalIncome; ?>（元）收入</p>
                <a class="detailButton" href="#" style="margin:10px;display:inline-block">显示详细信息</a>
                <table id="incomeDetail" class="mytable none" style="width:80%;margin-left:10%;marin-top:10px">
                	<thead>
                    	<tr>
                        	<th width="20%">日期</th>
                        	<th width="20%">收入</th>
                        	<th width="60%">比例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($incomeByDay as $key => $item): ?>
                    	<tr>
                        	<td><?php echo $key + 1; ?></td>
                        	<td><?php echo $item; ?></td>
                        	<td><div class="proportion"></div></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!--<p class="sysinfo" style="text-align:right;margin:5px 0;">单个业务运营统计信息可以在业务详细信息页中查看</p>-->
        </div>
    </div>
    
    <?php include('../../common/admin_footer.html'); ?>
</body>
</html>