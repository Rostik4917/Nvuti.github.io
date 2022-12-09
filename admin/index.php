<?php
require("../inc/bd.php"); 
require("../inc/site_config.php"); 
session_start();
$sid = $_SESSION['hash'];

// проверка на админа
$admin_check = "SELECT * FROM kot_user WHERE hash = '$sid'";
$result_admin = mysql_query($admin_check);
$row = mysql_fetch_array($result_admin);
if($row)
{	
$last_check = $row['admin'];
}
if($last_check == 1) {
  ?>
<!DOCTYPE html>
<html lang="ru" class="js">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
    

    <title><?=$sitename?> - админ-панель</title>
    <script src="https://kit.fontawesome.com/6cce539f85.js"></script>
    <meta name="description" content="<?=$sitename?> - Настоящий сайт Нвути. Все комиссии берем на себя, бонус при регистрации. Произведем выплаты за 24 часа на любую платежную систему.">
    <meta name="keywords" content="нвути, <?=$sitename?>">

    <meta name="author" content="<?=$linksite?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/vendor.bundle.css">
<link rel="stylesheet" href="../css/loader-0.css">
<link rel="stylesheet" href="../css/style.css?v=1575178639" id="layoutstyle">
<link rel="stylesheet" href="../css/datatables.min.css">
<script src="../script/jquery-latest.min.js"></script>
<script src="../script/odometr.js"></script>
<script src="../script/js.cookie.js"></script>
</head>

<body class="page-user no-touch">
 
    <div class="topbar-wrap" style="padding-top: 0px;">
        <div class="topbar is-sticky">
            <div class="container">
                <div>
                    <style>
                      
                        .mmmob {
                            display: none;
                        }
                        @media (max-width: 991px) {
                        
                          .form-control {
                        margin-left:-10px;
                        width:90%;
                        }
                          .form-group { 
                         width:100%;   
                        }
                          input { width:100%; }
                            .des {
                                display: none;
                            }
                            .mmmob {
                                display: block;
                            }
                            .desktop-nav {
                                margin-top: -55px;
                            }
                        }
                    </style>
                    <ul class="topbar-nav d-lg-none">
                        <li class="topbar-nav-item relative" id="close-nav"><a class="toggle-nav" href="">
                            <div class="toggle-icon"><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span></div>
                        </a></li>
                    </ul>
                    <center class="desktop-nav" style="font-weight: 600;padding: 5px;color: #fff;font-size: 25px;"><?=$sitename?></center>
                </div>
            </div><!-- .container -->
        </div><!-- .topbar -->
        <div class="navbar">
            <div class="container">
                <div class="navbar-innr">
                    <ul class="navbar-menu des">
                        <li class="active"><a href="/admin">Настройки сайта</a></li>
                        <li ><a href="/admin/users">Пользователи</a></li>
                        <li ><a href="/admin/promo">Промокоды</a></li>
                        <li ><a href="/admin/deps">Пополнения</a></li>
                        <li ><a href="/admin/withdraws">Выплаты</a></li>
                        <li ><a href="/admin/stat">Статистика сайта</a></li>
                    </ul>
                    <ul class="navbar-menu mmmob">
                        <li class="active"><a href="/admin">Настройки сайта</a></li>
                        <li ><a href="/admin/users">Пользователи</a></li>
                        <li ><a href="/admin/promo">Промокоды</a></li>
                        <li ><a href="/admin/deps">Пополнения</a></li>
                        <li ><a href="/admin/withdraws">Выплаты</a></li>
                        <li ><a href="/admin/stat">Статистика сайта</a></li>
                    </ul>
                    <ul class="navbar-btns">
                        <li><a href="<?=$group?>" target="_blank" class="btn btn-sm btn-outline btn-light"><em style="color: #3b5998;" class="fab fa-vk"></em><span>Вконтакте</span></a></li>
                    </ul>
                </div><!-- .navbar-innr -->
            </div><!-- .container -->
        </div><!-- .navbar -->
    </div><!-- .topbar-wrap -->
    
    <div class="page-content">
      <div class="container">
       <div class="card content-area">
	<div class="card-innr">
		<div class="card-head">
                      
			<h4 class="card-title card-title-lg" style='float:left; padding-top:8px;'>Настройки</h4>
                      <button id='saved' class="btn-ccc btn btn-sm btn-outline btn-light input-bordered" style="float:right; width:130px;" onclick="saves()">Сохранить</button><br><br>
                      <hr>
		</div>
                      <!-- НАЧАЛО -->
                      <center>
   <div class="row" id="setting-tbl" style="margin-right:2%;margin-left:2%;width:100%;">
                                                        <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Название сайта</label>
                                                            <input type="text" class="form-control" id="sitename" placeholder="Название сайта" value="<?=$sitename?>"/>
                                                          </div>
                                                        </div>
                      <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Домен сайта</label>
                                                            <input type="text" class="form-control" id="sitedomen" placeholder="Домен сайта" value="<?=$sitedomen?>"/>
                                                          </div>
                                                        </div>
                      <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Ссылка на группу VK</label>
                                                            <input type="text" class="form-control" id="sitegroup" placeholder="Ссылка на группу VK" value="<?=$group?>"/>
                                                          </div>
                                                        </div>
                      <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Ссылка на сообщения VK</label>
                                                            <input type="text" class="form-control" id="sitesupport" placeholder="Ссылка на сообщения VK" value="<?=$site_support?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Секретный ключ сайта</label>
                                                            <input type="text" class="form-control" id="sitesecret" placeholder="Ключ сайта" value="<?=$sitekey?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Мин. бонус в раздаче</label>
                                                            <input type="text" class="form-control" id="minbonus" placeholder="Мин бонус" value="<?=$min_bonus_s?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Макс. бонус в раздаче</label>
                                                            <input type="text" class="form-control" id="maxbonus" placeholder="Макс бонус" value="<?=$max_bonus_s?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Мин. сумма вывода</label>
                                                            <input type="text" class="form-control" id="minwithdraw" placeholder="Мин вывод" value="<?=$min_withdraw_sum?>"/>
                                                          </div>
                                                        </div>
                      <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Бонус за регистрацию</label>
                                                            <input type="text" class="form-control" id="bonusreg" placeholder="Бонус за регистрацию" value="<?=$bonus_reg?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>ID FK</label>
                                                            <input type="text" class="form-control" id="fkid" placeholder="ID мерчанта FK" value="<?=$fk_id?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Секрет 1 FK</label>
                                                            <input type="text" class="form-control" id="fksecret1" placeholder="Секрет 1 FK" value="<?=$fk_secret_1?>"/>
                                                          </div>
                                                        </div>
                       <div class="form-group">
                                                          <div class="col-lg-12" style="">
                                                            <label>Секрет 2 FK</label>
                                                            <input type="text" class="form-control" id="fksecret2" placeholder="Секрет 2 FK" value="<?=$fk_secret_2?>"/>
                                                          </div>
                                                        </div>
                      
                      </div>
                     
                      </center>
                       <!-- КОНЕЦ -->
		</div>
	</div>
</div><!-- .card -->
   </div><!-- .container -->
</div><!-- .page-content -->
                      
<div class="footer-bar">
  <div class="container">
   <div class="row align-items-center justify-content-center">
    <div class="col-md-8">
        <style>
         ul.footer-links li {
          display: inline;
      }
  </style>
</div><!-- .col -->
<div class="col-md-12 mt-12 mt-sm-12">
 <div class="d-flex justify-content-between justify-content-md-end align-items-center guttar-25px pdt-0-5x pdb-0-5x">
   <ul class="footer-links">
    <li><a href="#" data-toggle="modal" data-target="#modalRules">Лицензионное соглашение</a></li>
    <li><a href="#" data-toggle="modal" data-target="#modalNoAzart">Правила</a></li>
</ul>
</div>					
</div><!-- .col -->
</div><!-- .row -->
</div><!-- .container -->
</div><!-- .footer-bar -->

</div>
<!-- SCRIPT -->
    <script>
    function saves() {
 $.ajax({
                                                                                type: 'POST',
                                                                                url: '/admin/admin_func.php',
beforeSend: function() {
			   $('#saved').html('Сохранение..');
										},	
                                                                                data: {
         type: "save_edit",
         sitename: $("#sitename").val(),
         sitedomen: $("#sitedomen").val(),
         sitegroup: $("#sitegroup").val(),
         sitesupport: $("#sitesupport").val(),                                    
         sitesecret: $("#sitesecret").val(),
         minbonus: $("#minbonus").val(),
         maxbonus: $("#maxbonus").val(),                                                            
         minwithdraw: $("#minwithdraw").val(),                                         
         bonusreg: $("#bonusreg").val(),  
         fkid: $("#fkid").val(),                                                                                                                                fksecret1: $("#fksecret1").val(),
         fksecret2: $("#fksecret2").val()                                                                       
                                                                                                                            },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {

                //$("#succes_edit").show();                               
				$("#saved").html("Сохранить");
                     //$("#setting-tbl").load("index.php #setting-tbl");
                                            
                                                              
                                            }else{
                //$("#error_edit").show();                               
				//$("#error_edit").html(obj.error);
                                            }
                                        }   
   });
}
    </script>
    <!-- END -->
<script src="../script/jquery.bundle.js"></script>
<script src="../script/datatables.min.js"></script>
<script src="../script/script.js?v=2"></script>
<script src="../script/jquery-3.2.1.min.js"></script>
</body>
</html>
<?php } else { header('Location: ../error404'); } ?>