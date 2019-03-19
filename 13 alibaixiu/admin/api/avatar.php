<?php 

/*
根据用户邮箱获取用户头像
将email数据转换为img地址
 */
require_once '../../config.php';
if (empty($_GET['email'])) {
	exit('缺少必要参数');
}
$email = $_GET['email'];
//查询对应头像地址
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
	exit('连接数据库失败');
}
$query = mysqli_query($connection, "select avatar from users where email = '{$email}' limit 1;");
if (!$query) {
	exit('数据查询失败');
}
$row = mysqli_fetch_assoc($query);

echo $row['avatar'];