<?php
// 要写入的文件名字
$filename = 'ini.php';

$line = "\n";

// 写入的字符
$word = "<?php" . $line;
$word .= "\$config['siteName']='云媒体平台';" . $line;
$word .= "?>" . $line;

$fh = fopen($filename, "w");
echo fwrite($fh, $word);    // 输出：6
fclose($fh);
?>