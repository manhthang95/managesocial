@extends('layouts.master')
@section('content')
<div class="col-lg-12">
	<!--breadcrumbs start -->
	<div class="row">
	  <ul class="breadcrumb">
	      <li><a href="/welcome.html"><i class="fa fa-home"></i> Home</a></li>
	      <li><a href="/manage-user.html">Admin</a></li>
	      <li class="active">Chi tiết Admin</li>
	  </ul>
	</div>
		<!--breadcrumbs end -->
	 <!-- page start-->
	 <div class="row">
	   <section class="panel">
	    <header class="panel-heading">
	     Xem chi tiết thông tin Logs User
	    </header>
	    <div class="panel-body">
	     <div class="position-center">

	      <form class="form-horizontal" role="form" action="javascript:;">
	       <div class="form-group">
		<label for="code" class="col-lg-2 col-sm-2 control-label">ID</label>
		<div class="col-lg-10">
		 <span class="form-control"><?= $data['LogInfo']->id; ?></span>
		</div>
	       </div>
	       <div class="form-group">
		<label for="admin_id" class="col-lg-2 col-sm-2 control-label">User ID</label>
		<div class="col-lg-10">
		 <span class="form-control"><?= $data['LogInfo']->user_id; ?></span>
		</div>
	       </div>
	        <div class="form-group">
		<label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
		<div class="col-lg-10">
		 <span class="form-control"><?= $data['LogInfo']->email; ?></span>
		</div>
	       </div>
	       <div class="form-group">
		<label for="action" class="col-lg-2 col-sm-2 control-label">Action</label>
		<div class="col-lg-10">
		  <textarea class="form-control" name="action" id="action" rows="3"><?= $data['LogInfo']->action; ?></textarea>
		</div>
	       </div>
	        <div class="form-group">
		<label for="content" class="col-lg-2 col-sm-2 control-label">Content</label>
		<div class="col-lg-10">
		  <textarea class="form-control" name="content" id="content" rows="5" cols="5"><?= $data['LogInfo']->content; ?></textarea>
		</div>
	       </div>
	        
	        <div class="form-group">
		<label for="ip" class="col-lg-2 col-sm-2 control-label">IP</label>
		<div class="col-lg-10">
		 <span class="form-control"><?= $data['LogInfo']->ip; ?></span>
		</div>
	       </div>
	       
	       <div class="form-group">
		<label for="time" class="col-lg-2 col-sm-2 control-label">Time</label>
		<div class="col-lg-10">
		  <span class="form-control"><?= date("d-m-Y H:i:s",strtotime($data['LogInfo']->created_at)); ?></span>
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