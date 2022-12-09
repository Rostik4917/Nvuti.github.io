function deposit_default() {
   $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$('#depositButton').html('<div class="loader" style="height:23px;width:23px"></div>');  
$("#error_deposit").hide();
										},	
                                                                                data: {
                                                                                    type: "deposit",
           sum: $("#depositSize").val()
                                                                          
                                           
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                 $('#depositButton').html('Далее');                             
                  window.location.href = obj.locations;
                                                                return 
                                            }else{
                 $('#depositButton').html('Далее');                              
                $("#error_deposit").show();                               
                $("#error_deposit").html(obj.error); 
                                            }
                                        }   
   });
}
function continue_reg() {
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$('#contbutton').html('<div class="loader" style="height:23px;width:23px"></div>');  
$("#error_registerc").hide();
										},	
                                                                                data: {
                                                                                    type: "continue_reg",
           login: $("#updatelog").val(),
           pass: $("#updatepass").val()                                                               
                                           
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                 $('#contbutton').html('Продолжить');                             
                  location.reload(true);
                                                                return 
                                            }else{
                 $('#contbutton').html('Продолжить');                              
                $("#error_registerc").show();                               
                $("#error_registerc").html(obj.error); 
                                            }
                                        }   
   });
  
}
function register_default() {
  if(!$('#CheckBox_9').prop('checked')) {
    
                                
                                    $('#error_register').css('display', 'block');
           return $('#error_register').html('Поставьте галочку');
                                }
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {

										},	
                                                                                data: {
                                                                                    type: "registration",
           login: $("#userRegsiter").val(),
           pass: $("#userPassRegister").val(),                                      repeatpass: $("#userPassRegister1").val()                         
                                           
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                  location.reload(true);
                                                                return 
                                            }else{
                $("#error_register").show();                               
                $("#error_register").html(obj.error); 
                                            }
                                        }   
   });
}
function login_default() {
   $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {

										},	
                                                                                data: {
                                                                                    type: "login",
           login: $("#userLogin").val(),
           pass: $("#userPass").val()                                                                       
                                           
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                  location.reload(true);
                                                                return 
                                            }else{
                $("#error_enter").show();                               
                $("#error_enter").html(obj.error); 
                                            }
                                        }   
   });
}
function removeWithdrawUser(deletew) {
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {

										},	
                                                                                data: {
                                                                                    type: "deletewithdraw",
           del: deletew
                                           
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                   $("#withdrawT").load("index.php #withdrawT");                           
                                                    $('#userBalance').attr('myBalance', obj.new_balance);
                                                                        updateBalance(obj.balance, obj.new_balance);
                                                                return 
                                            }else{
                $("#withdrawT").load("index.php #withdrawT"); 
                                            }
                                        }   
   });
}
function createwithdraw() {
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$('#withB').html('<div class="loader" style="height:23px;width:23px"></div>');
$("#succes_withdraw").hide(); 
  $("#error_withdraw").hide(); 
										},	
                                                                                data: {
                                                                                    type: "withdrawuser",
           system: $('#hide_search').val(),
           wallet: $('#walletNumber').val(),                                        sum: $('#WithdrawSize').val()                                   
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                   $("#withdrawT").load("index.php #withdrawT");                           
                    $("#withB").html('Вывести');                          
                    $("#succes_withdraw").show();                          
					$("#succes_withdraw").html("Выплата успешно создана"); 
                                              $('#userBalance').attr('myBalance', obj.new_balance);
                                                                        updateBalance(obj.balance, obj.new_balance);
                                                                return 
                                            }else{
                 $("#withB").html('Вывести'); 
                $("#error_withdraw").show();                               
				$("#error_withdraw").html(obj.error);
                                            }
                                        }   
   });
}
function createpromo() {

 $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$('#createbutton').html('<div class="loader" style="height:23px;width:23px"></div>');
$("#succes_promocreate").hide(); 
  $("#error_promocreate").hide(); 
										},	
                                                                                data: {
                                                                                    type: "createPromoUser",
           createname: $('#createname').val(),
           createsum: $('#createsum').val(),                                        createactive: $('#createactive').val()                                   
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                    $('#createbutton').html('Создать');                         
                    $("#succes_promocreate").show();                          
					$("#succes_promocreate").html("Промокод создан"); 
                                              $('#userBalance').attr('myBalance', obj.new_balance);
                                                                        updateBalance(obj.balance, obj.new_balance);
                                                                return 
                                            }else{
                $('#createbutton').html('Создать');                               
                $("#error_promocreate").show();                               
				$("#error_promocreate").html(obj.error);
                                            }
                                        }   
   });
}
function activepromo() {
/*  setTimeout(function() {
    $("#error_promoactive").fadeOut();
    $("#succes_promoactive").fadeOut(); 
  }, 5000); */
  if($('#promoactive').val() == '') {
    $("#error_promoactive").show();                               
				 return $("#error_promoactive").html("Введите промокод");
  }
 $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
  $('#activebutton').html('<div class="loader" style="height:23px;width:23px"></div>');
$("#succes_promoactive").hide(); 
  $("#error_promoactive").hide(); 
										},	
                                                                                data: {
                                                                                    type: "activePromo",
           promoactive: $('#promoactive').val()                                                                       
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                    $('#activebutton').html('Активировать');                           
                    $("#succes_promoactive").show();                          
					$("#succes_promoactive").html("Промокод активирован"); 
                                              $('#userBalance').attr('myBalance', obj.new_balance);
                                                                        updateBalance(obj.balance, obj.new_balance);
                                                                return 
                                            }else{
                $('#activebutton').html('Активировать');                               
                $("#error_promoactive").show();                               
				$("#error_promoactive").html(obj.error);
                                            }
                                        }   
   });
}
function getDaily() {
 $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$("#succes_promo").hide(); 
  $("#error_promo").hide(); 
										},	
                                                                                data: {
                                                                                    type: "bonus"
           },
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            if (obj.success == "success") {
                    $("#succes_promo").show();                          
					$("#succes_promo").html("Получено в раздаче <b>"+ obj.bonussize + "</b>"); 
                                              $('#userBalance').attr('myBalance', obj.new_balance);
                                                                        updateBalance(obj.balance, obj.new_balance);
                                                                return 
                                            }else{
                $("#error_promo").show();                               
				$("#error_promo").html(obj.error);
                                            }
                                        }   
   });
}