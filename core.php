<?php
require("inc/bd.php");
session_start();
$sid = $_SESSION['hash'];
$randn = rand(0,999999);
$rand = rand(1,100);
$randc = rand(1,95);
$chancee = rand(1,95) * 10000;
$selectik = rand(1,2);
if($selectik == 1) {
$typed = "lose";
}
if($selectik == 2) {
$typed = "win";
}
$names = array('Kot', 'Админ', 'Бот', 'Хвост', 'ffd', 'Kotik', 'YouTube', 'Nvuti', 'Xvuti', 'Ислам', 'Кыс-кыс', 'Негриттос', 'Зомби', 'Ботиха', 'Дед Максим', 'СайтТоп', 'Комп');
$randname = rand(0,16);
$logbot = $names[$randname];
$bot = "INSERT INTO `kot_games` (`id`, `user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) VALUES (NULL, '1', '$logbot', '$randn', '0-$chancee', '$rand', '$randc', '$typed', '$rand');";
 // mysql_query($bot);

$sql_select5 = "SELECT COUNT(*) FROM kot_user WHERE online=1";
$result5 = mysql_query($sql_select5);
$row2 = mysql_fetch_array($result5);
$online = $row2['COUNT(*)'];
$sql_select = "SELECT * FROM kot_games ORDER BY `id` DESC LIMIT 15";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
do
{
 
	$sql_select1 = "SELECT * FROM kot_user WHERE id=".$row['user_id'];
$result1 = mysql_query($sql_select1);
$row1 = mysql_fetch_array($result1);

if($row['chance'] >= 60)
{
	$sts = "success";
}
if($row['chance'] < 60 && $row['chance'] >= 30)
{
	$sts = "warning";
}
if($row['chance'] <= 29)
{
	$sts = "danger";
}

if($row['type'] == "win")
{
	$st = "success";
}
if($row['type'] == "lose")
{
	$st = "danger";
}
$login = ucfirst($row['login']);
	$game =  <<<HERE
$game
<tr data-user="2370363" data-game="1"><td>$login</td><td class="text-$st" style="font-weight:600">$row[number]</td><td style='width:120px;'>$row[cel]</td><td>$row[sum]</td><td><div class="progress"><div class="progress-bar bg-$sts" role="progressbar" style="width: $row[chance]%"></div></div></td><td class="text-$st" style="font-weight:600">$row[win_summa]</td></tr>

HERE;
$st = "";
$sts = "";
$login = "";
}
while($row = mysql_fetch_array($result));
$time = time() + 5;
$update_sql111 = "Update kot_user set online='1', online_time='$time' WHERE hash='$sid'";
    mysql_query($update_sql111) or die("" . mysql_error());
	
	$sql_select = "SELECT COUNT(*) FROM kot_user WHERE online='1'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);

$online = $row['COUNT(*)'];

    $result = array(
	'game' => "$game",
    'online' => "$online"
    );
	
    echo json_encode($result);
?>