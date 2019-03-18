<?php 

//封装常用函数
// JS 判断函数是否重名方式：typeof fn === 'function'
// PHP 判断函数是否定义的方式： function_exists('get_current_user')

require_once 'config.php';

session_start();
/**
 * 获取当前登录用户信息，如果没有获取到则自动跳转到登录页面
 * @return [type] [description]
 */

function baixiu_get_current_user () {
	if (empty($_SESSION['current_login_user'])) {
		header('Location: /admin/login.php');
		exit();
	}
	return $_SESSION['current_login_user'];
}

/**
 * 通过一个数据库查询获取多条数据
 * => 索引数组套关联数组
 */
function baixiu_fetch_all ($sql) {
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$conn) {
		exit('数据库连接失败');
	}
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		// exit('查询失败')；
		return false;
	}
	
	while ($row = mysqli_fetch_assoc($query)) {
		$result[] = $row;
	}
	mysqli_free_result($query);
	mysqli_close($conn);
	return $result;
}
/**
 * 获取单条数据
 * => 关联数组
 */
function baixiu_fetch_one ($sql) {
	$res = baixiu_fetch_all($sql);
	return isset($res[0]) ? $res[0] : null;
}

/**
 * 执行一个增删改语句
 */
function baixiu_excute ($sql) {
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$conn) {
		exit('数据库连接失败');
	}
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		// exit('查询失败')；
		return false;
	}
	  // 对于增删修改类的操作都是获取受影响行数
	$affected_rows = mysqli_affected_rows($conn);
	mysqli_free_result($query);
	mysqli_close($conn);
	return $affected_rows;
}