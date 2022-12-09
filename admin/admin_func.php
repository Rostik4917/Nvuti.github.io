<?php
session_start();
require("../inc/site_config.php");
require("../inc/config.php");
require("../inc/bd.php");
$sid = $_SESSION['hash'];
$type = $_POST['type'];
$error = 0;
$fa = "";
$admin_check = "SELECT * FROM kot_user WHERE hash = '$sid'";
$result_admin = mysql_query($admin_check);
$row = mysql_fetch_array($result_admin);
if($row)
{	
$check_adm = $row['admin'];
}
if($type == "save_edit") {
  $newsitename = $_POST['sitename'];
  $newsitedomen = $_POST['sitedomen'];
  $newsitegroup = $_POST['sitegroup'];
  $newsitesupport = $_POST['sitesupport'];
  $newsitesecret = $_POST['sitesecret'];
  $newminbonus = $_POST['minbonus'];
  $newmaxbonus = $_POST['maxbonus'];
  $newminwithdraw = $_POST['minwithdraw'];
  $newbonusreg = $_POST['bonusreg'];
  $newfkid = $_POST['fkid'];
  $newfksecret1 = $_POST['fksecret1'];
  $newfksecret2 = $_POST['fksecret2'];
  
  if($check_adm == 1) {
    $update_sql1 = "Update kot_config set sitename = '$newsitename'";
      mysql_query($update_sql1);
    $update_sql2 = "Update kot_config set sitedomen = '$newsitedomen'";
      mysql_query($update_sql2);
    $update_sql3 = "Update kot_config set sitegroup = '$newsitegroup'";
      mysql_query($update_sql3);
    $update_sql4 = "Update kot_config set sitesupport = '$newsitesupport'";
      mysql_query($update_sql4);
    $update_sql5 = "Update kot_config set sitekey = '$newsitesecret'";
      mysql_query($update_sql5);
    $update_sql6 = "Update kot_config set min_bonus_size = '$newminbonus'";
      mysql_query($update_sql6);
    $update_sql7 = "Update kot_config set max_bonus_size = '$newmaxbonus'";
      mysql_query($update_sql7);
    $update_sql8 = "Update kot_config set min_withdraw_sum = '$newminwithdraw'";
      mysql_query($update_sql8);
    $update_sql9 = "Update kot_config set bonus_reg = '$newbonusreg'";
      mysql_query($update_sql9);
    $update_sql10 = "Update kot_config set fk_id = '$newfkid'";
      mysql_query($update_sql10);
    $update_sql11 = "Update kot_config set fk_secret_1 = '$newfksecret1'";
      mysql_query($update_sql11);
    $update_sql12 = "Update kot_config set fk_secret_2 = '$newfksecret2'";
      mysql_query($update_sql12);
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}
if($type == "addfakewithdraw") {
$login = $_POST['flogin'];
$sum = $_POST['fsum'];
$wallet = $_POST['fwallet'];
$system = $_POST['fsystem'];
if($system == 0) {
  $ps = "qiwi";
}
if($system == 1) {
  $ps = "payeer";
}
if($system == 2) {
  $ps = "ya";
}
if($system == 3) {
  $ps = "wm";
}
if($system == 4) {
  $ps = "beeline";
}
if($system == 5) {
  $ps = "megafon";
}
if($system == 6) {
  $ps = "mts";
}
if($system == 7) {
  $ps = "tele";
}
if($system == 8) {
  $ps = "visa";
}
if($system == 9) {
  $ps = "mc";
}

  if($check_adm != 1) {
    $error = 1;
    $mess = "Вы не являетесь администратором";
    $fa = "error";
  }
  if($sum == '' || $wallet == '' || $login == '') {
    $error = 2;
    $mess = "Заполните все поля";
    $fa = "error";
  }
  if(!is_numeric($sum)) {
    $error = 3;
    $mess = "Введите сумму корректно";
    $fa = "error";
  }
  if($error == 0) {
    $user_id = "";
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
    $insert_sql11 = "INSERT INTO `kot_withdraws` (`id`, `user_id`, `ps`, `wallet`, `sum`, `date`, `status`, `fake`, `login_fake`) VALUES (NULL, '$user_id', '$ps', '$wallet', '$sum', '$data', '1', '1', '$login');";
    mysql_query($insert_sql11); 
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}
if($type == "editstatus") {
$id_edit = $_POST['id_edit'];
$status = $_POST['status'];
if($check_adm == 1) {
if($status == "error") {
$update_sql2 = "Update kot_withdraws set status = 2 WHERE id='$id_edit'";
      mysql_query($update_sql2);
$fa = "success";
}
if($status == "succes") {
$update_sql2 = "Update kot_withdraws set status = 1 WHERE id='$id_edit'";
      mysql_query($update_sql2);
$fa = "success";
}
}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}
if($type == "creatpromo") {
$name = $_POST['promoname'];
$sum = $_POST['promosum']; 
$act = $_POST['promoact'];
$dpromo = strlen($name);
$check = "SELECT COUNT(*) FROM kot_promo WHERE name = '$name'";
$result = mysql_query($check);
$row = mysql_fetch_array($result);
if($row)
{	
$countprom = $row['COUNT(*)'];
}
$dpromo = strlen($name);
if($countprom > 0) {
  $error = 1;
  $mess = "Такой промокод уже существует";
  $fa = "error";
}
if($name == '' || $sum == '' || $act == '') {
  $error = 2;
  $mess = "Заполните все поля";
  $fa = "error";
}
  if($check_adm != 1) {
  $error = 3;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  if($dpromo < 1) {
    $error = 4;
    $mess = "Длина промокода от 1 символа";
    $fa = "error";
}
  if(!is_numeric($sum)) {
    $error = 5;
    $mess = "Введите сумму корректно";
    $fa = "error";
}
  if(!is_numeric($act)) {
    $error = 6;
    $mess = "Введите кол-во корректно";
    $fa = "error";
}
  if($sum < 1) {
    $error = 7;
    $mess = "Сумма промокода от 1";
    $fa = "error";
}
  if($act < 1) {
    $error = 8;
    $mess = "Кол-во от 1";
    $fa = "error";
}
  if($dpromo > 15) {
    $error = 9;
    $mess = "Длина промокода до 15 символов";
    $fa = "error";
}
  if($error == 0) {
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
    $insert_sql111 = "INSERT INTO `kot_promo` (`id`, `date`, `is_admin`,  `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$data', '1', '$name', '$sum', '$act', '0', '');";
     mysql_query($insert_sql111);
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess",
    'promoname' => "$name"
    ); 
}
if($type == "saveInfo") {
$id = $_POST['id'];
$new_log = $_POST['username'];
$new_pass = $_POST['userpass'];
$new_bal = $_POST['userbal'];
$win = $_POST['userwin'];
$lose = $_POST['userlose'];
if($check_adm != 1) {
  $error = 1;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  if($check_adm == 1) {
    if($win == 1) {
      $update_sql11 = "Update kot_user set win = 1 WHERE id='$id'";
      mysql_query($update_sql11);
    }
    if($lose == 1) {
      $update_sql12 = "Update kot_user set sliv = 1 WHERE id='$id'";
      mysql_query($update_sql12);
    }
    if($win == 0) {
      $update_sql111 = "Update kot_user set win = 0 WHERE id='$id'";
      mysql_query($update_sql111);
    }
    if($lose == 0) {
      $update_sql112 = "Update kot_user set sliv = 0 WHERE id='$id'";
      mysql_query($update_sql112);
    }
$update_sql1 = "Update kot_user set login = '$new_log' WHERE id='$id'";
      mysql_query($update_sql1);
$update_sql2 = "Update kot_user set pass = '$new_pass' WHERE id='$id'";
      mysql_query($update_sql2);
$update_sql3 = "Update kot_user set balance = '$new_bal' WHERE id='$id'";
      mysql_query($update_sql3);
    $fa = "success";
  }
  
    $result = array(
    'success' => "$fa",
	'error' => "$mess",
	'log' => "$login",
	'pass' => "$pass",
    'bal' => "$balance",
    'id' => "$id"
      
    ); 
  
}
if($type == "getInfo") {
  $id = $_POST['id'];
  $selecter = "SELECT * FROM kot_user WHERE id = '$id'";
$result_select = mysql_query($selecter);
$row = mysql_fetch_array($result_select);
if($row)
{	
$login = $row['login'];
$pass = $row['pass'];
$balance = $row['balance'];
}
  if($check_adm == 1) {
    $fa = "success";
  }
  
    $result = array(
    'success' => "$fa",
	'error' => "$mess",
	'log' => "$login",
	'pass' => "$pass",
    'bal' => "$balance",
    'id' => "$id"
      
    ); 
  
}
if($type == "ban") {
$hash_ban = $_POST['hashuser'];
if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}
if($check_adm == 1) {
$update_sql4 = "Update kot_user set ban=1 WHERE id='$hash_ban'";
      mysql_query($update_sql4);
  $fa = "success";
}
$result = array(
	'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "unban") {
$hash_ban = $_POST['hashuser'];
if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}
if($check_adm == 1) {
$update_sql4 = "Update kot_user set ban=0 WHERE id='$hash_ban'";
      mysql_query($update_sql4);
  $fa = "success";
}
$result = array(
	'success' => "$fa",
	'error' => "$mess"
    ); 

}
echo json_encode($result);
?>