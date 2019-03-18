<?php 

require_once '../functions.php';
if (empty($_GET['id'])){
	exit('缺少必要参数');
}
$id = $_GET['id'];
$rows = baixiu_excute('delete from categories where id in (' . $id . ')');
header ('Location: /admin/categories.php');
