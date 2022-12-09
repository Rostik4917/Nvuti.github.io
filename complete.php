<?php
require("inc/site_config.php");
require("inc/bd.php");
session_start();
$sid = $_SESSION['hash'];
$selecter1 = "SELECT * FROM kot_user WHERE hash = '$sid'";
         $result4 = mysql_query($selecter1);
         $row = mysql_fetch_array($result4);
		 if($row)
		{	
          $vk_name = $row['vk_name'];
          $login = $row['login'];
          $pass = $row['pass'];
        }
if($login != '' && $pass != '') {
  header('Location: /');
}
if($_SESSION['login'] != 1 || $_SESSION['hash'] == '') {
  header('Location: /');
}
  ?>
<!DOCTYPE html>

<html lang="ru" class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="<?=$sitename?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.ico"><!-- Site Title  -->
    <title><?=$sitename?> - завершение регистрации</title><!-- Vendor Bundle CSS -->
    <meta name="description" content="<?=$sitename?> - Настоящий сайт Нвути. Все комиссии берем на себя, бонус при регистрации. Произведем выплаты за 24 часа на любую платежную систему.">
    <link rel="stylesheet" href="../css/vendor.bundle.css">
    <link rel="stylesheet" href="../css/loader-0.css">
    <link rel="stylesheet" href="../css/style.css" id="layoutstyle">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <script src="../ajax/functions.js"></script>
    <script src="../script/jquery-latest.min.js"></script>
    <script src="../script/odometr.js"></script>
    <script src="../script/js.cookie.js"></script>

</head>

<body class="page-user no-touch">

    <div class="topbar-wrap" style="padding-top: 0px;">
        <div class="topbar is-sticky">
            <div class="container">
                <div class="">
                    <style>
                        @media (max-width: 991px) {
                            .desktop-nav {
                                margin-top: -55px;
                            }

                        }
                       @media (min-width: 991px) {
                            .input-with-label { 
                                float: left;
                                width:30%;
                             }
                            .right {
                                float:right;
                                width:60%;
                                margin-left:10%;
                            }

                        }
                     @media (max-width: 360px) {
                            .left {
                                float: none;
                            }
                             .right {
                                float: none;
                            }
                             .input-with-label { 
                                float: none;
                             }
                        }
                    </style>
                    <ul class="topbar-nav d-lg-none">
                        <li class="topbar-nav-item relative"><a class="toggle-nav">
                                <div class="toggle-icon"><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span><span class="toggle-line"></span></div>
                            </a></li>
                    </ul>
                    <center onclick='window.location.href="/"' class="desktop-nav" style="cursor:pointer;font-weight: 600;padding: 5px;color: #fff;font-size: 25px;"><?=$sitename?></center>
                </div>
            </div><!-- .container -->
        </div><!-- .topbar -->
        <div class="navbar">
            <div class="container">

                <div class="navbar-innr">

                    <ul class="navbar-menu">
                       <li><a href="/">Главная</a></li>
                        <li><a href="/check.php">Честная игра</a></li>
                        <li><a href="/faq.php">FAQ</a></li>
                        <li><a href="/support.php">Контакты</a></li>
                        <li><a href="/withdraws.php">Выплаты</a></li>
					    <li><a href="#" onclick="exit()">Выйти</a></li>
                    </ul>
                    <ul class="navbar-btns">
                        <li><a href="<?=$group?>" target="_blank" class="btn btn-sm btn-outline btn-light"><em style="color: #3b5998;" class="fab fa-vk"></em><span>Вконтакте</span></a></li>
                    </ul>
                </div><!-- .navbar-innr -->
            </div><!-- .container -->
        </div><!-- .navbar -->
    </div><!-- .topbar-wrap -->
    <div class="page-content">
        <div class="page-header page-header-kyc">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center">
                <h4 class="page-title"><?=$vk_name?>, придумайте логин и пароль для вашего аккаунта!</h4>
                <p class="large"></p>
            </div>
        </div>
    </div><!-- .container -->
</div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="kyc-status card mx-lg-4">
                        <div class="card-innr">
                            
                            <div class="content">
                              
                             <div class="terms__wrapper">


           <center>
                      <div class="complete-block left">
                                                    <div  style=''class=" input-item input-with-label">
                                                        <label for="full-name" style="margin-bottom:5px" class="input-item-label text-center">Логин</label>
                                                        <p><input autocomplete="off" id="updatelog" style="width:100%" class="input-bordered text-center" maxlength="15" value="" required></p>
                                                    
                                                          
                                                        <label for="full-name" style="margin-bottom:5px" class="input-item-label text-center">Пароль</label>
                                                        <p><input id="updatepass" style="width:100%; margin-top:3px;" type="password" class="input-bordered text-center" maxlength="12" value="" required></p>
                                                          <p></p>
     <div class="btn btn-danger btn-block" id="error_registerc" style="margin-top:15px;display:none;pointer-events:none"></div>                                                     
    <button id="contbutton" class="btn btn-primary" style="width:100%; box-shadow: 0 5px 23px 0 rgba(0, 125, 255, 0.3); color:#fff;margin-top: 10px; width:100%" onclick="continue_reg()">Продолжить</button>                                                      </div>
               <div style='' class="complete-block terms__wrapper right">                                   <h5>Для чего это нужно?</h5>
            <p>
             Вы сможете входить в свой аккаунт через логин и пароль,</p> <p>если ваша страница ВК заблокирована </p>                                            
            
            
                                          </div>
                                              </center>           

          </div>
                                                          
                        </div>
                    </div><!-- .card -->
               
                </div>
            </div>
        </div><!-- .container -->
    </div>
<div class="footer-bar">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12">
                <ul class="footer-links">
                    <li><a href="/terms.php">Пользовательское соглашение</a></li>
                    <li><a href="/policy.php">Политика конфеденциальности</a></li>
                </ul>
            </div><!-- .col -->
            <!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<script>
       function exit() {
$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
					
										},	
                                                                                data: {
                                                                                    type: "exit"
                                                                                  
                                                                                   
                                                                                    
                                                                                },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                                               
					location.reload(true);
                                                                return 
                                            }else{
                                               
				alert('Что-то пошло не так, обратитесь в поддержку...');
                                            }
                                        }   
   });
                              
}                                                   
                                                          
</script>                                                          
        <script src="../script/jquery.bundle.js"></script>
        <script src="../script/script.js"></script>
        <script>
        
        var jgjger = setInterval(function() {
  console.log("%cОстановитесь!","color: red; font-size: 42px; font-weight: 700"),console.log("%cЕсли кто-то сказал вам, что вы можете скопировать и вставить что-то здесь, то это мошенничество, которое даст злоумышленнику доступ к вашему аккаунту.","font-size: 20px;");
  
}, 2000);

setTimeout(function() {
  clearInterval(jgjger);
  console.log("%cОстановитесь!","color: red; font-size: 42px; font-weight: 700"),console.log("%cЕсли кто-то сказал вам, что вы можете скопировать и вставить что-то здесь, то это мошенничество, которое даст злоумышленнику доступ к вашему аккаунту.","font-size: 20px;");
  
}, 30000);
    </script>

</body>

</html>