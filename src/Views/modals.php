<script type="text/javascript">

$('#search').typeahead({
  
    source: function (query, result) {
        $.ajax({
            url: "./../backend/ajax/server.php",
            data: 'query=' + query,            
            dataType: "json",
            type: "POST",
            success: function (data) {
    result($.map(data, function (item) {
      return item;
                }));
            }
        });
    }
});

$('#search').change(function() {
  var tex = $(this).val();
  texAry = tex.split(" [in ");
  txtcnt = texAry.length;
  if(txtcnt > 1) {
    $('#search').val(texAry[0]);
  }
});

$('#sign_in').click(function() {
  alert('Blasaaaaaaaaaaaaaaaaaaaaaaa');
  event.preventDefault();
  var email = $('#log_email').val();
  var password = $('#log_pass').val();
  //var rem = $('#customCheckLogin2').val();

  if(email == "" || password == "") {
    $('#showErr').text("Email/Password can't be blank");
    $('.emailPassErr').slideDown();
  }else {
    $.ajax({
        method: "POST",
        data: {
          email: email,
          password: password
        },
        url: 'http://localhost/vensle-current/ajax/login'
      }).done(function(data) {
          console.log("feedbacksayopaulo");
          $('#dFeedBack').text(data);
          myFeedbk = parseInt($('#dFeedBack').text());

          if(myFeedbk == 1) {
            location.reload();
          }else {
            $('#showErr').text("Email/Password wrong");
            $('.emailPassErr').slideDown();
          }
    });
  }
});

$('#card_submit').click(function() {
event.preventDefault();

var card_email = $('#card_email').val();
var card_pass = $('#card_pass').val();

if(card_email == "" || card_pass == "") {
  $('#card_showErr').text("Email/Password can't be blank");
  $('.card_emailPassErr').slideDown();
}else {
  $.ajax({
      method: 'POST',
      data: {
        email: card_email,
        password: card_pass
      },
      url: './backend/ajax/authentication.php'
    }).done(function(data) {
        if(data == 1) {
          location.reload();
        }else {
          $('#card_showErr').text("Email/Password wrong");
          $('.card_emailPassErr').slideDown();
        }
  });
}
});


$('#regSubmt').click(function() {
event.preventDefault();

var fullName = $('#regFullName').val();
var busName = $('#regBusName').val();
var regEmail = $('#regEml').val();
var phone = $('#regPhn').val();
var address = $('#regAdrs').val();
var regPass = $('#regPass').val();
var regPassAgn = $('#regPassAgn').val();

authErr = [];

if(fullName == ""){
  authErr.push("<p>Full name can't be blank</p>");
  $('#regFullName').addClass("redBrd");
}else {
  $('#regFullName').removeClass("redBrd");
}

if(regEmail == ""){
  authErr.push("<p>Email can't be blank</p>");
  $('#regEml').addClass("redBrd");
}else {
  $('#regEml').removeClass("redBrd");
}

if(phone == ""){
  authErr.push("<p>Phone number can't be blank</p>");
  $('#regPhn').addClass("redBrd");
}else {
  $('#regPhn').removeClass("redBrd");
}

if(address == ""){
  authErr.push("<p>Address can't be blank</p>");
  $('#regAdrs').addClass("redBrd");
}else {
  $('#regAdrs').removeClass("redBrd");
}

if(regPass == ""){
  authErr.push("<p>Password can't be blank</p>");
  $('#regPass').addClass("redBrd");
}else {
  $('#regPass').removeClass("redBrd");
  if(regPass != regPassAgn) {
    authErr.push("<p>Both passwords do not match</p>");
    $('#regPass').addClass("redBrd");
    $('#regPassAgn').addClass("redBrd");
  }else {
    $('#regPass').removeClass("redBrd");
    $('#regPassAgn').removeClass("redBrd");
  }
}



if(authErr == "") {
  $.ajax({
      method: 'POST',
      data: {
        fullName : fullName,
        busName : busName, 
        regEmail : regEmail,
        phone : phone,
        address : address,
        regPass : regPass, 
        regPassAgn : regPassAgn,
        submit: 'submit'
      },
      url: 'http://localhost/vensle-current/ajax/register'
    }).done(function(data) {
        console.log(data)
        
        if(data == 3) {
            authErr.push("<p>That email is in use. Please try another one</p>");
            $('#regEml').addClass("redBrd");
            $('#regShwErr').html(authErr);
            $('#regShwErr').slideDown();
        }else {
            authErr == "";
            $('#regEml').removeClass("redBrd");
        }

        if(data == 2) {
            authErr.push("<p>Something went wrong please try again");
            $('#regShwErr').html(authErr);
            $('#regShwErr').slideDown();
        }

        if(data == 1) {
          locatn = document.location.origin;
          window.location = locatn + '/vensle-current/login';
        }       

  });
}    

$('#regShwErr').html(authErr);
$('#regShwErr').slideDown();
});

$('.sndMail').click(function() {
var clkId = $(this).attr("id");
if(clkId == 'repAbuse') {
  $('#contctSub').val('abuse');
}else {
  $('#contctSub').val('');
}
});

$('#subReprt').click(function() {
event.preventDefault();

var contctName = $('#contctName').val();
var contctemail = $('#contctemail').val();
var contctSub = $('#contctSub').val();
var contctMsg = $('#contctMsg').val();

var allCntErr = [];

var prog = [];


if(contctName == ""){
  allCntErr.push("<p>Name can't be blank</p>");
  $('#contctName').addClass("redBrd");
}else {
  $('#contctName').removeClass("redBrd");
}

if(contctemail == ""){
  allCntErr.push("<p>Email can't be blank</p>");
  $('#contctemail').addClass("redBrd");
}else {
  $('#contctemail').removeClass("redBrd");
}
if(contctSub == ""){
  allCntErr.push("<p>Option can't be blank</p>");
  $('#contctMsg').addClass("redBrd");
}else {
  $('#contctMsg').removeClass("redBrd");
}

if(contctMsg == ""){
  allCntErr.push("<p>Message can't be blank</p>");
  $('#contctMsg').addClass("redBrd");
}else {
  $('#contctMsg').removeClass("redBrd");
}


if(allCntErr == "") {
  
  $.ajax({
      method: 'POST',
      data: {
        contctName  : contctName,
        contctemail : contctemail, 
        contctSub   : contctSub,
        contctMsg   : contctMsg,
        submitCnt: 'submitCnt'
      },
      url: '../backend/ajax/authentication.php'
    }).done(function(data) {
      if(data == 1) {
        $('#contctSnt').html('<h4>Thank you for contacting us</h4>');
        $('#contctSnt').css({"display":"block"});

        $('#contctName').val('');
        $('#contctemail').val('');
        $('#contctSub').val('');
        $('#contctMsg').val('');
      }else {
        $('#contctSnt').html('');
      }
  });
}else {
  $('#contctSnt').css({"display":"none"});
  $('#contctSnt').html('');
}    

$('#contctErr').html(allCntErr);
$('#contctErr').slideDown();
$('#contctErr').slideDown();
});

$(function () {
$('[data-toggle="popover"]').popover()
})

$(document).ready(function() {
var delay = 2000;
$('.btn-new').click(function(e){
  e.preventDefault();
  var name = $('#contctName').val();
  if(name == ''){
    $('.message_box').html(
    '<span style="color:red;">Enter Your Name!</span>'
    );
    $('#contctName').focus();
    return false;
    }
  
  var email = $('#contctemail').val();
  if(email == ''){
    $('.message_box').html(
    '<span style="color:red;">Enter Email Address!</span>'
    );
    $('#email').focus();
    return false;
    }
  if( $("#email").val()!='' ){
    if( !isValidEmailAddress( $("#contctemail").val() ) ){
    $('.message_box').html(
    '<span style="color:red;">Provided email address is incorrect!</span>'
    );
    $('#contctemail').focus();
    return false;
    }
    }
    
  var message = $('#contctMsg').val();
  if(message == ''){
    $('.message_box').html(
    '<span style="color:red;">Enter Your Message Here!</span>'
    );
    $('#contctMsg').focus();
    return false;
    } 
   var subject = $('#contctSub').val();
  if(subject == ''){
    $('.message_box').html(
    '<span style="color:red;">Select an Option! </span>'
    );
    $('#subject').focus();
    return false;
    } 
    //alert('Name :' + name +  '<br> Email :'+ email +'<br> Subject :'+ subject +'<br> Message :'+ message +' has been Entered.')
        
    $.ajax
    ({
     type: "POST",
     url: "./backend/ajax/ajax.php",
     //data: "name="+name+"&email="+email+"&subject"+subject+"&message="+message,
     data :{
      name: name,
      email:email,
      subject:subject,
      message:message,
     },
     beforeSend: function() {
     $('.message_box').html(
     '<img src="./backend/includes/Loader.gif" width="25" height="25"/>'
     );
     },    
     success: function(data)
     {
       setTimeout(function() {
        $('.message_box').html(data);
      }, delay);
    
     }
     });
});
    
});

//Email validation Function 
function isValidEmailAddress(emailAddress) {
var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
return pattern.test(emailAddress);
};
  
</script>