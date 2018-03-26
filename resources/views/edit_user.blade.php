@extends('layouts.master')
@section('content')
<div class="col-lg-12">
  	<!--breadcrumbs start -->
  <div class="row">
	  <ul class="breadcrumb">
	      <li><a href="/welcome.html"><i class="fa fa-home"></i> Home</a></li>
	      <li><a href="/manage-user.html">Admin</a></li>
	      <li class="active">Cập nhật Admin</li>
	  </ul>
	</div>
  	<!--breadcrumbs end -->
  	<div class="row">
       <div class="col-lg-12">
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
          <section class="panel">
             <header class="panel-heading">
                Cập nhật Admin
             </header>
             <div class="panel-body">
                <div class="form">
                   <form class="form-horizontal" action="javascript:;">
                      <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                      <div class="form-group">
                         <label for="name" class="control-label col-lg-2">Name</label>
                         <div class="col-lg-10">
                            <input class=" form-control" id="name" name="name" type="text" value="{{ $data['UserInfo']->name }}">
                         </div>
                      </div>
                      <div class="form-group ">
                         <label for="email" class="control-label col-lg-2">Email</label>
                         <div class="col-lg-10">
                            <input disabled="" class="form-control" id="email" name="email" type="text" value="{{ $data['UserInfo']->email }}">
                         </div>
                      </div>
                      <div class="form-group ">
                         <label for="password" class="control-label col-lg-2">Password</label>
                         <div class="col-lg-10">
                            <input class="form-control " id="password" name="password" type="password">
                         </div>
                      </div>
                      <div class="form-group ">
                         <label for="confirm_password" class="control-label col-lg-2">Confirm Password</label>
                         <div class="col-lg-10">
                            <input class="form-control " id="confirm_password" name="confirm_password" type="password">
                         </div>
                      </div>
                      <div class="form-group ">
                         <label for="email" class="control-label col-lg-2">Is Root</label>
                         <div class="col-lg-10">
                            <select class="form-control" name="is_root" id="is_root">
                              <option value="yes" {{ ($data['UserInfo']->is_root == "yes") ? "selected" : "" }}>Yes</option>
                              <option value="no" {{ ($data['UserInfo']->is_root == "no") ? "selected" : "" }}>No</option>
                            </select>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="col-lg-offset-2 col-lg-10">
                            <button onclick="return edit_user();" class="btn btn-danger" type="submit">Cập nhật</button>
                            <a href="/manage-user.html" class="btn btn-default" type="button">Cancel</a>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
          </section>
       </div>
    </div>
</div>
@endsection
@section('script_bottom')
<!--script for this page-->
<script type="text/javascript">

  function edit_user(){
    name = $("#name").val();
    password = $("#password").val();
    confirm_password = $("#confirm_password").val();
    is_root = $("#is_root").val();
    _token = $("#_token").val();
    if (name === "") {
      $("#content_error").text("Bạn chưa nhập name !");
      $("#show_success").hide();
      $("#show_error").show();
      $('#show_error').delay(3000).hide("slow");
      $("#name").focus();
      return false;
    }
    if (is_root === "") {
      $("#content_error").text("Bạn chưa nhập is root !");
      $("#show_success").hide();
      $("#show_error").show();
      $('#show_error').delay(3000).hide("slow");
      $("#is_root").focus();
      return false;
    }
    if(password != confirm_password){
      $("#content_error").text("Mật khẩu không trùng khớp !");
      $("#show_success").hide();
      $("#show_error").show();
      $('#show_error').delay(3000).hide("slow");
      $("#password").focus();
      return false;
    }

    $.post("/manage-user/edit-user-action/{{ $data['UserInfo']->id }}.html", {
        name : name,
        password : password,
        is_root : is_root,
        _token : _token
    }, function(res) {
        $('html, body').animate({scrollTop: 0}, 'fast');
        if (res.status) {
            $("#content_success").text(res.msg);
            $("#show_success").show();
            clear_form();
            return false;
        } else {
            $("#content_error").text(res.msg);
            $("#show_error").show();
            $('#show_error').delay(3000).hide("slow");
            return false;
        }
    }).fail(function() {
        alert("Hệ thống gặp lỗi, vui lòng thử lại sau !");
        return false;
    });

  }
</script>
@endsection