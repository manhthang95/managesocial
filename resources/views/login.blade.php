<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<head>

<title>Login Social Tool</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<!-- Custom-Style-Sheet -->
<link rel="stylesheet" href="/login/css/bootstrap.css"	type="text/css" media="all">
<link rel="stylesheet" href="/login/css/validify.css"	type="text/css" media="all">
<link rel="stylesheet" href="/login/css/style.css"		type="text/css" media="all">
<!-- //Custom-Style-Sheet -->

<!-- Fonts -->
<link rel="stylesheet" href="/login/fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"		type="text/css" media="all">
<link rel="stylesheet" href="/login/fonts.googleapis.com/css?family=Montserrat:400,700"					type="text/css" media="all">
<link rel="stylesheet" href="/login/netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"	type="text/css" media="all">
<!-- //Fonts -->

<!-- Style -->
<style type="text/css">
	@-webkit-keyframes AnimationName {
		0%{background-position:15% 0%}
		50%{background-position:86% 100%}
		100%{background-position:15% 0%}
	}

	@-moz-keyframes AnimationName {
		0%{background-position:15% 0%}
		50%{background-position:86% 100%}
		100%{background-position:15% 0%}
	}

	@keyframes AnimationName { 
		0%{background-position:15% 0%}
		50%{background-position:86% 100%}
		100%{background-position:15% 0%}
	}

	.textbox {
		margin: 20px 0;
		padding: 15px 20px;
		color: #fff;
		background-color: rgba(0, 0, 0, .25);
		border: 1px solid #CCC;
		border-radius: 0;
		box-shadow: none !important;
		transition: all .2s linear;
	}

	.btn-osx, button[disabled] {
		padding: 5px 10px;
		color: #fff;
		background-color: rgba(0, 0, 0, .1)!important;
		border: 1px solid rgba(255, 255, 255, .2);
		box-shadow: none !important;
		transition: all .2s linear;
		border-radius: 50%;
		font-size: 20px;
	}

	.btn-default:hover, .btn-default:focus, .btn-default.focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
		color: #FFF;
		opacity: 1;
		border-color: #FFF!important;
	}

	@media screen and (max-width: 640px) {
		.textbox {
			margin: 20px 0;
			padding: 12px;
			font-size: 13px;
		}
	}

</style>
<!-- //Style -->

</head>
<!-- //Head -->



	<!-- Body -->
	<body>

		<h1>LOGIN Social TOOL</h1>

		<div class="containerw3layouts-agileits">

			<form action="#" method="post" id="demo" novalidate>
				<div class="form-group agileits-w3layouts">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
					<input type="email" class="form-control agileinfo textbox" name="user_email" id="user_email" required placeholder="Email">
				</div>
				<div class="form-group w3-agile password">
					<input type="password" name="user_password" id="user_password" class="form-control w3-agileits textbox" required placeholder="Password">
				</div>
				<div class="form-group w3-agile submit">
					<button class="btn btn-default btn-osx w3-agileits btn-lg" disabled type="submit"><i class="fa agileinfo fa-arrow-circle-right"></i></button>
				</div>
				<div class="alert agileits-w3layouts alert-success" id="content_success" style="display: none;">Đăng nhập thành công!</div>
				<div class="alert agileits-w3layouts alert-danger" id="content_error" style="display: none;">Đăng nhập không thành công!</div>
			</form>

		</div>

		<div class="w3lsfooteragileits">
			<p> &copy; 2018 Tam Hữu Media | Design by <a href="http://w3layouts.com" target="=_blank">W3layouts</a></p>
		</div>



		<!-- Necessary-JavaScript-Files-&-Links -->

			<!-- Default-JavaScript --><script type="text/javascript" src="/login/js/jquery.min.js"></script>

			<script type="text/javascript">
		        $(document).keypress(function (e) {
		            if (e.which == 13) {
		                login();
		            }
		        });
			    
			    function login(){
			    	var user_email = $("#user_email").val();
			        var user_password = $("#user_password").val();
			        var _token = $("#_token").val();
			        if(user_email == ""){
			            $("#content_error").show();
			            $("#content_error").text("Bạn chưa nhập Email !");
			            $("#user_email").focus();
			            return false;
			        }
			        if(!validateEmail(user_email)){
			            $("#content_error").show();
			            $("#content_error").text("Email không đúng định dạng !");
			            $("#user_email").focus();
			            return false;
			        }
			        if(user_password == ""){
			            $("#content_error").show();
			            $("#content_error").text("Bạn chưa nhập mật khẩu !");
			            $("#user_password").focus();
			            return false;
			        }

		            $.post('/login-action.html', {
		                user_email: user_email,
		                user_password: user_password,
		                _token: _token
		            }, function(res) {
		                if (res.status) {
		                	$("#content_success").show();
		                	$("#content_error").hide();
		                    window.location.href = res.url;
		                } else {
		                	$("#content_success").hide();
		                    $("#content_error").show();
		                    $("#content_error").text('Login Unsuccessful');
		                    return false;
		                }
		            }).fail(function() {
		                alert('Hệ thống gặp lỗi, vui lòng thử lại sau.');
		                return false;
		            });
			    }
			    
			    function validateEmail(email) {
			        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			        return re.test(email);
			    }
			</script>

		<!-- //Necessary-JavaScript-Files-&-Links -->



	</body>
	<!-- //Body -->



</html>