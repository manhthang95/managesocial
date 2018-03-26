@extends('layouts.master')
@section('content')
<div class="col-lg-12">
<!--breadcrumbs start -->
	<div class="row">
	  <ul class="breadcrumb">
	      <li><a href="/welcome.html"><i class="fa fa-home"></i> Home</a></li>
	      <li class="active">Cập nhật thông tin</li>
	  </ul>
	</div>
<!--breadcrumbs end -->
 <!-- page start-->
	 <div class="row">
	  
	   <section class="panel">
	    <header class="panel-heading">
	     CẬP NHẬT THÔNG TIN CÁ NHÂN
	    </header>
	    <div class="panel-body">
	     <div class="position-center">
	     	<div class="alert alert-success fade in text-center" id="show_success" style="display: none;">
	            <button data-dismiss="alert" class="close close-sm" type="button">
	                <i class="fa fa-times"></i>
	            </button>
	            <strong>Thông báo !</strong> <span id="content_success"></span>
	        </div>

	        <div class="alert alert-block alert-danger fade in text-center" id="show_error" style="display: none;">
	            <button data-dismiss="alert" class="close close-sm" type="button">
	                <i class="fa fa-times"></i>
	            </button>
	            <strong>Thông báo !</strong> <span id="content_error"></span>
	        </div>

	      <form class="form-horizontal" role="form" action="javascript:;">
		    <div class="form-group">
				<label for="code" class="col-lg-2 col-sm-2 control-label">Email</label>
				<div class="col-lg-10">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				 <input id="email" name="email" type="email" class="form-control" value="{{ $data['email'] }}" />
				</div>
		    </div>
		   	<div class="form-group">
				<label for="admin_id" class="col-lg-2 col-sm-2 control-label">Password</label>
				<div class="col-lg-10">
				 	<input id="password" name='password' type="password" class="form-control" placeholder="**********" />
				</div>
		    </div>
		    <div class="form-group">
				<label for="admin_id" class="col-lg-2 col-sm-2 control-label">Confirm Password</label>
				<div class="col-lg-10">
				 	<input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="**********" />
				</div>
		    </div>
		    <div class="form-group">
				<label for="admin_id" class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
				<div class="col-lg-10">
				 	<button onclick="return update_profile();" class="btn btn-primary">Cập nhật</button>
				</div>
		    </div>
	      </form>
	     </div>
	    </div>
	   </section>
	  </div>
</div>
 <!-- page end-->
@stop
@section('script_bottom')
<script type="text/javascript">
    function resetError(){
        $("#show_error").hide();
    }
    function update_profile() {
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var _token = $("#_token").val();
        if(password != "" || confirm_password != ""){ 
            if (password === "") {
                $("#content_error").text("Bạn chưa nhập mật khẩu !");
                $("#show_error").show();
                $("#password").focus();
                return false;
            }

            if (password.length < 6) {
                $("#content_error").text("Mật khẩu phải trên 6 ký tự !");
                $("#show_error").show();
                $("#password").focus();
                return false;
            }

            if (confirm_password === "") {
                $("#content_error").text("Bạn chưa nhập lại mật khẩu !");
                $("#show_error").show();
                $("#re-password").focus();
                return false;
            }

            if(confirm_password != password){
                $("#content_error").text("Nhập lại mật khẩu không chính xác !");
                $("#show_error").show();
                $("#re-password").focus();
                return false;
            }
        }

        $.post("/my-profile/edit-profile-action.html", {
            id : <?= Auth::User()->id; ?>,
            password : password,
            _token: _token
        }, function(res) {
            $('html, body').animate({scrollTop: 0}, 'fast');
            if (res.status) {
                $("#content_success").text(res.msg);
                $("#show_success").show();
                return false;
            } else {
                $("#content_error").text(res.msg);
                $("#show_error").show();
                return false;
            }
        }).fail(function() {
            alert("Hệ thống gặp lỗi, vui lòng thử lại sau !");
            return false;
        });
    }
</script>
@endsection