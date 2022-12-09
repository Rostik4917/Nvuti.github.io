<?php
  session_start();
$sid = $_SESSION['hash'];
require("inc/site_config.php");
require("inc/config.php");
require("inc/bd.php");
$pass = $_POST['pass'];
$login = $_POST['login'];
$type = $_POST['type'];
$email = $_POST['email'];
$error = 0;
$fa = "";
if($type == "resetPassPanel") {
 $newpass = $_POST['newPass'];
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$newpass)) {
    $error = 1;
	$mess = "Недопустимые символы";
	$fa = "error";	
  }
  if($error == 0) {
 $update_sql2 = "UPDATE kot_user SET pass = '$newpass' WHERE hash = '$sid'";
    mysql_query($update_sql2); 
  $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess"
    );
}
if($type == "deposit")
{
	
$size = $_POST['sum'];
$sql_select = "SELECT * FROM kot_user WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$bala = $row['balance'];
$user_id = $row['id'];
}
 
  if($error == 0) {
$podpis = md5($fk_id.':'.$size.':'.$fk_secret_1.':'. $user_id);
  $fa = "success";
}
    $result = array(
	'success' => "success",
	'locations' => "http://www.free-kassa.ru/merchant/cash.php?m=".$fk_id."&oa={$size}&o={$user_id}&s=".$podpis.""
    );
  

}
if($type == "continue_reg") {
  $login = $_POST['login'];
  $pass = $_POST['pass'];
  $dllogin = strlen($login);
  $dlpass = strlen($pass);
  $sql_select1 = sprintf("SELECT COUNT(*) FROM kot_user WHERE login='%s'", mysql_real_escape_string($login));
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{
$count = $row['COUNT(*)'];
}  
  if($login == '' || $pass == '') {
   $error = 1;
   $mess = "Заполните все поля";
   $fa = "error";
  }
  if($login != '' && $pass != '') {
  if($dllogin < 5 || $dllogin > 15) {
   $error = 2;
   $mess = "Логин от 5 до 15 симв.";
   $fa = "error";
  }
  if($dlpass < 6 || $dlpass > 12) {
   $error = 3;
   $mess = "Пароль от 6 до 12 симв.";
   $fa = "error";
  }
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$login)) {
    $error = 4;
	$mess = "Недопустимые символы";
	$fa = "error";	
  }
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$pass)) {
    $error = 5;
	$mess = "Недопустимые символы";
	$fa = "error";	
  } 
  if($count >= 1) {
    $error = 6;
	$mess = "Логин занят";
	$fa = "error";	
  }
  }
  if($error == 0) {
    $update_sql1 = "UPDATE kot_user SET login = '$login' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $update_sql2 = "UPDATE kot_user SET pass = '$pass' WHERE hash = '$sid'";
    mysql_query($update_sql2);
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess"
    );
}
if($type == "registration") {
  $login1 = $_POST['login'];
  $pass = $_POST['pass'];
  $repeatpass = $_POST['repeatpass'];
  $dllogin = strlen($login1);
  $dlpass = strlen($pass);
  $sql_select1 = sprintf("SELECT COUNT(*) FROM kot_user WHERE login='%s'", mysql_real_escape_string($login1));
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{
$count = $row['COUNT(*)'];
}
$ip_c = $_SERVER['REMOTE_ADDR'];
$sql_select11 = sprintf("SELECT COUNT(*) FROM kot_user WHERE ip='%s'", mysql_real_escape_string($ip_c));
$result11 = mysql_query($sql_select11);
$row = mysql_fetch_array($result11);
if($row)
{
$count_ip = $row['COUNT(*)'];
}
  if($login1 == '' || $pass == '' || $repeatpass == '') {
    $error = 1;
    $mess = "Заполните все поля";
    $fa = "error";
  }
  if($pass != $repeatpass) {
    $error = 2;
    $mess = "Пароли не совпадают";
    $fa = "error";
  }
  if($login1 != '' && $pass != '' && $repeatpass != '') {
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$login1)) {
    $error = 3;
	$mess = "Недопустимые символы";
	$fa = "error";	
  }
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$pass)) {
    $error = 4;
	$mess = "Недопустимые символы";
	$fa = "error";	
  } 
  if($dllogin < 4 || $dllogin > 20) {
    $error = 5;
    $mess = "Логин от 4 до 20 симв.";
    $fa = "error";
  }
  if($count >= 1) {
    $error = 6;
    $mess = "Логин занят";
    $fa = "error";  
  }
  if($count_ip >= 1) {
    $error = 7;
    $mess = "Такой IP уже зареган";
    $fa = "error";
  }
    if($dlpass < 6 || $dlpass > 12) {
    $error = 8;
    $mess = "Пароль от 6 до 12 симв.";
    $fa = "error";
  }
  }
  if($error == 0) {
$ip = $_SERVER["REMOTE_ADDR"];
$ref = $_SESSION["ref"];
$datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
	$chars3="qazxswedcvfrtgnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
$max3=32; 
$size3=StrLen($chars3)-1; 
$passwords3=null; 
while($max3--) 
$hash.=$chars3[rand(32,$size3)];
	$insert_sql1 = "INSERT INTO `kot_user` (`date_reg`, `ip`, `ref_id`, `login`, `pass`, `hash`, `balance`, `social`) 
	VALUES ('{$data}', '{$ip}', '{$ref}', '{$login}', '{$pass}', '{$hash}', '{$bonus_reg}', '');";
mysql_query($insert_sql1);
    $_SESSION['hash'] = $hash;
    $_SESSION['login'] = 1;
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess"
    );
}
if($type == "login") {
  $login = $_POST['login'];
  $pass = $_POST['pass'];
  $sql_select1 = sprintf("SELECT COUNT(*) FROM kot_user WHERE login='%s' AND pass='%s'", mysql_real_escape_string($login), mysql_real_escape_string($pass));
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{
$count = $row['COUNT(*)'];
}  
  if($login == '' || $pass == '') {
    $error = 1;
    $mess = "Заполните все поля";
    $fa = "error";
  }
  if($login != '' && $pass != '') {
  if($count == 0) {
    $error = 2;
    $mess = "Пользователь не найден";
    $fa = "error";
  }
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$login)) {
    $error = 3;
	$mess = "Недопустимые символы";
	$fa = "error";	
} 
  if (!preg_match("#^[aA-zZ0-9\-_]+$#",$pass)) {
    $error = 4;
	$mess = "Недопустимые символы";
	$fa = "error";
} 
  }
  if($error == 0) {
    $sql_select2 = sprintf("SELECT * FROM kot_user WHERE login='%s' AND pass='%s'", mysql_real_escape_string($login), mysql_real_escape_string($pass));
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$hash = $row['hash'];   
}
    $_SESSION['hash'] = $hash;
    $_SESSION['login'] = 1;
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess"
    );
}
if($type == "deletewithdraw") {
  $id_delete = $_POST['del'];
$sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$user_id = $row['id'];
$login = $row['login'];
$ban = $row['ban'];
$balance = $row['balance'];
}
$sql_select3 = "SELECT * FROM kot_withdraws WHERE id='$id_delete'";
$result3 = mysql_query($sql_select3);
$row = mysql_fetch_array($result3);
if($row)
{
$user_id_w = $row['user_id'];
$sum = $row['sum'];
$status = $row['status'];
}  
if($status != 0) {
   $error = 1;
   $mess = "";
   $fa = "error";
}
if($user_id != $user_id_w) {
   $error = 2;
   $mess = "";
   $fa = "error";
}
  if($error == 0) {
    $delete = "DELETE FROM `kot_withdraws` WHERE id = '$id_delete'";
mysql_query($delete);
  $newbalance = $balance + $sum;
    $update_sql1 = "UPDATE kot_user SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance"
    );
}
if($type == "withdrawuser") {
$sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$user_id = $row['id'];
$login = $row['login'];
$ban = $row['ban'];
$balance = $row['balance'];
}
$system = $_POST['system'];
$wallet = $_POST['wallet'];
$sum = $_POST['sum'];
  if($system == 4) {
      $ps = "qiwi";
    }
    if($system == 2) {
      $ps = "payeer";
    }
    if($system == 3) {
      $ps = "wm";
    }
    if($system == 1) {
      $ps = "ya";
    }
    if($system == 5) {
      $ps = "beeline";
    }
    if($system == 6) {
      $ps = "megafon";
    }
    if($system == 7) {
      $ps = "mts";
    }
    if($system == 8) {
      $ps = "tele";
    }
    if($system == 9) {
      $ps = "visa";
    }
    if($system == 10) {
      $ps = "mc";
    }
$dwallet = strlen($wallet);
if($wallet == '' || $sum == '') {
  $error = 1;
  $mess = "Заполните все поля";
  $fa = "error";
}
if($sum > $balance) {
  $error = 2;
  $mess = "Недостаточно средств";
  $fa = "error";
}
if($ban == 1) {
  $error = 3;
  $mess = "Ваш аккаунт заблокирован";
  $fa = "error";
}
  if($sum != '' && $wallet != '') {
if(!is_numeric($sum)) {
  $error = 4;
  $mess = "Введите корректную сумму";
  $fa = "error";
}
if($dwallet < 8 || $dwallet > 20) {
  $error = 5;
  $mess = "Кошелек от 8 до 20 символов";
  $fa = "error";
}
  
if($sum < $min_withdraw_sum) {
  $error = 6;
  $mess = "Минимальная сумма вывода $min_withdraw_sum";
  $fa = "error";
}
if (!preg_match("#^[aA-zZ0-9\-_.]+$#",$sum)) 
{
	$mess = "Недопустимые символы в сумме";
	$fa = "error";
	$error = 7;
} 
if (!preg_match("#^[+0-9PpWw]+$#",$wallet)) 
{
	$mess = "Недопустимые символы в реквизитах";
	$fa = "error";
	$error = 8;
} 
  }
  if($error == 0) {
    $summ = round($sum, 2);
    $newbalance = $balance - $sum;
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
    $insert_sql11 = "INSERT INTO `kot_withdraws` (`id`, `user_id`, `ps`, `wallet`, `sum`, `date`, `status`) VALUES (NULL, '$user_id', '$ps', '$wallet', '$summ', '$data', '0');";
    mysql_query($insert_sql11); 
    $update_sql1 = "UPDATE kot_user SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $fa = "success";
}
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance"
    );
}
if($type == "createPromoUser") {

$sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$user_id = $row['id'];
$ban = $row['ban'];
$balance = $row['balance'];
}
$name = $_POST['createname'];
$sum = $_POST['createsum'];
$act = $_POST['createactive'];
$sql_select4 = sprintf("SELECT COUNT(*) FROM kot_promo WHERE name='%s'", mysql_real_escape_string($name));
$result4 = mysql_query($sql_select4);
$row = mysql_fetch_array($result4);
if($row)
{
$count = $row['COUNT(*)'];
}
if($name == '' || $sum == '' || $act == '') {
  $error = 1;
  $mess = "Заполните все поля";
  $fa = "error";
}
if($ban == 1) {
  $error = 2;
  $mess = "Ваш аккаунт заблокирован";
  $fa = "error";
}
if(($sum * $act) > $balance) {
  $error = 3;
  $mess = "Недостаточно средств";
  $fa = "error";
}
  if($name != '' && $sum != '' && $act != '') {
  if($sum < 1) {
  $error = 4;
  $mess = "Сумма от 1";
  $fa = "error";
}
  if($act < 1) {
  $error = 5;
  $mess = "Кол-во от 1";
  $fa = "error";
}
  if(!is_numeric($sum)) {
  $error = 6;
  $mess = "Сумма цифрами";
  $fa = "error";
}
  if(!is_numeric($act)) {
  $error = 7;
  $mess = "Кол-во цифрами";
  $fa = "error";
}
  if (!preg_match("#^[а-яА-ЯaA-zZ0-9\-_]+$#",$name)) {
   $error = 8;
   $mess = "Недопустимые символы";
   $fa = "error";
}   
  if($count > 0) {
  $error = 9;
  $mess = "Промокод уже существует";
  $fa = "error";
}  
}
  if($error == 0) {
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
  $newbalance = $balance - ($sum * $act);
  $insert_sql1 = "INSERT INTO `kot_promo` (`id`, `date`, `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$data', '$name', '$sum', '$act', '0', '');";
    mysql_query($insert_sql1);
    $update_sql1 = "UPDATE kot_user SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $fa = "success";
}
$result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance"
    );
}
if($type == "activePromo") {
  
$sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$user_id = $row['id'];
$ban = $row['ban'];
$balance = $row['balance'];
}
// инфу о пользователе мы получили, получаем промо
$promo = $_POST['promoactive']; // получаем введенное промо
$sql_select = sprintf("SELECT COUNT(*) FROM kot_promo WHERE name='%s'", mysql_real_escape_string($promo));
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$count = $row['COUNT(*)'];
}
 
  if($promo == '') {
    $error = 1;
    $mess = "Введите промокод";
    $fa = "error";
  }
  if($count == 0) {
    $error = 2;
    $mess = "Промокод не найден";
    $fa = "error";
  }
 if($count != 0) {
    $sql_select1 = "SELECT * FROM kot_promo WHERE name='$promo'";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{	
$sum = $row['sum'];
$limit = $row['active'];
$actived = $row['actived'];
$idactive = $row['id_active'];
}
  }
  if($count == 1) {
  if($limit == $actived || $actived > $limit) {
    $error = 3;
    $mess = "Активации закончились";
    $fa = "error";
  }
  if($ban == 1) {
    $error = 4;
    $mess = "Ваш аккаунт заблокирован";
    $fa = "error";
  }
  }
  if (preg_match("/$user_id /",$idactive))  {	
	$error = 5;
    $mess = "Вы уже активировали этот код";
    $fa = "error";
   }
  if($error == 0) {
    $newbalance = $balance + $sum;
    $newactive = $actived + 1;
    $newid = "$user_id $idactive";
    $update_sql1 = "UPDATE kot_user SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    // обновляем бд (2)
    $update_sql2 = "UPDATE kot_promo SET actived = '$newactive' WHERE name = '$promo'";
    mysql_query($update_sql2); 
    // обновляем бд (3)
    $update_sql3 = "UPDATE kot_promo SET id_active = '$newid' WHERE name = '$promo'";
    mysql_query($update_sql3);
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance"
    );
}
if($type == "bonus")	
{
$min_bonus_size = $min_bonus_s * 100;
$max_bonus_size = $max_bonus_s * 100;
$data = Date("dmY");	
$sql_select = "SELECT * FROM kot_user WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$bonus = $row['bdate'];
$balance = $row['balance'];
}
if($bonus == $data){
    $error = 5;
$fa = "error";
$mess = "Вы получали бонус за эти 24 часа";
}else{
    $randomb = rand($min_bonus_size,$max_bonus_size) / 100;
$balancenew = $balance + $randomb;
$update_sql = "Update kot_user set balance='$balancenew' WHERE hash='$sid'";
      mysql_query($update_sql) or die("Ошибка вставки" . mysql_error());
$update_sql = "Update kot_user set bdate='$data' WHERE hash='$sid'";
      mysql_query($update_sql) or die("Ошибка вставки" . mysql_error());
$fa = "success";
} 
$result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$balancenew",
	'bonussize' => "$randomb"
    );
}

if($type == "exit") {
 unset($_SESSION['hash']); 
 unset($_SESSION['login']);
  $fa = "success";
  $result = array(
	'success' => "$fa",
	'error' => "$mess"
    );
}
if($type == "minbet") {
 // $winsum = $_POST['win'];
  
  $sum = $_POST['sum'];
  $per = $_POST['per'];
  $nwin = ($per * 10000) - 1;
  $winsum = round(((100 / $per * $sum) - $sum), 2);
  //$nwin = $_POST['nwin'];
  $sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$ban = $row['ban'];
$sliv = $row['sliv'];
$fart = $row['win'];
$login = $row['login'];
$user_id = $row['id'];
}
  if($fart == 0) {
  if($sliv == 0) {
  $rand = rand(0,999999);
  }
  }
  if($sliv == 1) {
    $rand = rand($nwin, 999999);
  }
  if($fart == 1) {
    $rand = rand(0, $nwin);
  }
  $hash = hash('sha512', $rand);
  if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
     if($_SESSION['hash'] != '') {
       if($sum > $balance) {
         $newbalance = $balance;
         $error = 4;
         $mess = "Недостаточно средств";
         $fa = "error";
       }
       if($per > 95 || $per < 1) {
         $newbalance = $balance;
         $error = 98;
         $mess = "% Шанс от 1 до 95";
         $fa = "error";
       }
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       if($sum < 1) {
         $newbalance = $balance;
         $error = 64;
         $mess = "Ставки от 1 рубля";
         $fa = "error";
       }
       if(!is_numeric($sum)) {
           $newbalance = $balance;
         $error = 77;
         $mess = "Введите сумму корректно";
         $fa = "error";
          
       }
       if($error == 0) {
  if($rand <= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('NULL', '$user_id', '$login', '$rand', '0 - $nwin', '$summ', '$per', 'win', '$winsumm');";
mysql_query($insert_sql1);
  $newbalance = $balance + $winsum;
    $update_sql4 = "Update kot_user set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $fa = "success";
  }
       }
       
       if($error == 0) {
  if($rand > $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('NULL', '$user_id', '$login', '$rand', '0 - $nwin', '$summ', '$per', 'lose', '0');";
mysql_query($insert_sql1);
  $newbalance = $balance - $sum;
    $update_sql4 = "Update kot_user set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $error = 1;
  $mess = "Выпало <b>$rand</b>";
  $fa = "error";
  }
   }  
     }
     
  $winning = $winsum + $sum;
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'number' => "$rand",
    'hash' => "$hash",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance"

    );
}
if($type == "maxbet") {
  // $winsum = $_POST['win'];
  $per = $_POST['per'];
  $nwin = 1000000 - ($per * 10000);
  //$nwin = $_POST['nwin'];
  $sum = $_POST['sum'];
  $winsum = round(((100 / $per * $sum) - $sum), 2);
  $sql_select2 = "SELECT * FROM kot_user WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$balance = $row['balance'];
$ban = $row['ban'];
$sliv = $row['sliv'];
$fart = $row['win'];
$login = $row['login'];
$user_id = $row['id'];
}
  if($fart == 0) {
  if($sliv == 0) {
  $rand = rand(0,999999);
  }
  }
  if($sliv == 1) {
    $rand = rand(0, $nwin);
  }
  if($fart == 1) {
    $rand = rand($nwin, 999999);
  }
  $hash = hash('sha512', $rand);
  if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
  if($sum < 1) {
    	 $newbalance = $balance;
         $error = 44;
         $mess = "Ставки от 1 рубля";
         $fa = "error";
       }
     if($_SESSION['hash'] != '') {
       if($sum > $balance) {
         $newbalance = $balance;
         $error = 4;
         $mess = "Недостаточно средств";
         $fa = "error";
       }
       if($per > 95 || $per < 1) {
         $balance = $balance;
         $newbalance = $balance;
         $error = 98;
         $mess = "% Шанс от 1 до 95";
         $fa = "error";
       }
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       if(!is_numeric($sum)) {
           $newbalance = $balance;
         $error = 77;
         $mess = "Введите сумму корректно";
         $fa = "error";
          
       }
       if($error == 0) {
  if($rand >= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('NULL', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$per', 'win', '$winsumm');";
mysql_query($insert_sql1);
  $newbalance = $balance + $winsum;
    $update_sql4 = "Update kot_user set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $fa = "success";
  }
       } 
     }
    
       
       if($error == 0) {
  if($rand < $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('NULL', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$per', 'lose', '0');";
mysql_query($insert_sql1);
  $newbalance = $balance - $sum;
    $update_sql4 = "Update kot_user set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $error = 1;
  $mess = "Выпало <b>$rand</b>";
  $fa = "error";
  }
       }
     
     
  $winning = $winsum + $sum;
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'number' => "$rand",
    'hash' => "$hash",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance"

    );
}

	/* огромное спасибо за покупку, моя страница в вк - https://vk.com/id321223555 по всем вопросам и т.д */
    echo json_encode($result);
?>