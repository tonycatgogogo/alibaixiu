<?php 

require_once '../functions.php';
if (empty($_GET['id'])){
	exit('缺少必要参数');
}
$id = $_GET['id'];
$rows = baixiu_excute('delete from posts where id in (' . $id . ')');
header ('Location: /admin/posts.php');
