<?php
	require('../../lib/db.class.php');
	$db = new DB();
	
	$p = isset($_GET['p']) ? $_GET['p'] : 1;
	$pageSize = 2;
	$sql = 'SELECT COUNT(*) FROM `news`';
	$total = $db->count($sql);
	$totalPage = ceil($total / $pageSize);
	if(!ctype_digit($p) || $p < 1 || $p > $totalPage){
		$p = 1;
	}
	$offset = ($p - 1) * $pageSize;
	
	$sql = "SELECT * FROM `news` LIMIT $offset, $pageSize";
	//$sql = 'SELECT * FROM `news` LIMIT $offset, $pageSize';
	//echo $sql;
	$news = $db->select($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻</title>
</head>

<body>
	<table width="800" style="margin:auto">
    	<thead>
        	<tr>
            	<th>新闻标题</th>
                <th>新闻内容</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($news as $key => $item): ?>
        	<tr>
            	<td align="center"><?php echo $item->title; ?></td>
                <td align="center"><?php echo $item->content; ?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s', $item->create_time); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="page" style="text-align:center">
    	<?php
		if($p == 1){
        	echo '上一页';
		}else{
			echo '<a href="news.php?p=' . ($p - 1) .'">上一页</a>';
		}
        echo '&nbsp;&nbsp;' . $p . '&nbsp;&nbsp;';

		if($p == $totalPage){
        	echo '下一页';
		}else{
			echo '<a href="news.php?p=' . ($p + 1) .'">下一页</a>';
		}
		?>
    </div>
</body>
</html>