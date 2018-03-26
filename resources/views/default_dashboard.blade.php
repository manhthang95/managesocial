@extends('layouts.master')
@section('content')
	<section class="wrapper">
	 <!--mini statistics start-->
	 <div class="row">
	  <div class="col-md-12">
	   <div class="mini-stat clearfix">
	    <div class="mini-stat-info text-center">
	      <h3>Welcome, <font color="red">{{ Auth::User()->name }}</font></h3>
	      <?php
	      if(isset($data['gif_image_url']) && $data['gif_image_url']){
	          ?>
	     <img src="<?= $data['gif_image_url']; ?>" width="<?= $data['image_width']; ?>" height="<?= $data['image_height']; ?>"> 
	      <?php
	      }else{
	      ?>
	     <img src="/dashboard/<?= $array_image[$random_image]; ?>.gif" width="200" height="180">
	     <?php
	      }
	     ?>
	    </div>
	   </div>
	  </div>
	 </div>
	</section>
@endsection