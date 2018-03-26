@extends('layouts.master')
@section('content')
<div class="col-lg-12">
  	<!--breadcrumbs start -->
  <div class="row">
	  <ul class="breadcrumb">
	      <li><a href="/welcome.html"><i class="fa fa-home"></i> Home</a></li>
	      <li><a href="/manage-user.html">Admin</a></li>
	      <li class="active">Danh sách Logs Admin</li>
	  </ul>
	</div>
	<!--breadcrumbs end -->
  <div class="row">
    <section class="panel">
        <header class="panel-heading">
            Tìm kiếm
        </header>
        <div class="panel-body">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="sr-only" for="user">Email</label>
                    <input type="text" class="form-control" id="user" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="action">Action</label>
                    <input type="text" class="form-control" id="action" placeholder="Enter Action">
                </div>
                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                    <input type="text" class="form-control datepicker" name="startdate" id="startdate">
                    <span class="input-group-addon">To</span>
                    <input type="text" class="form-control datepicker" name="enddate" id="enddate">
                </div>
                <button type="submit" class="btn btn-success" onclick="return filter()">Search</button>
            </form>

        </div>
    </section>
  </div>
	<div class="row">
      <section class="panel">
          <header class="panel-heading">
                Có tổng số <font color="red">{{ $data['total'] }}</font> logs action admin
          </header>
          <table class="table table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th><i class="fa fa-bullhorn"></i> Email</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Action</th>
                    <th><i class="fa fa-bookmark"></i> IP</th>
                    <th><i class=" fa fa-edit"></i> Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@if(isset($data['AllLogs']) && $data['AllLogs'])
				@foreach($data['AllLogs'] as $log)
                	<tr>
                    <td>
                      {{ $log->email }}
                    </td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->ip }} </td>
                    <td>{{ date("d-m-Y H:i:s", strtotime($log->created_at)) }}</td>
                    <td>
                        <a href="manage-user-logs/detail-user-logs/{{ $log->id }}.html" title='Chi tiết' class="btn btn-primary btn-xs"><i class="fa fa-inbox"></i></a>
                    </td>
                	</tr>
                	@endforeach
                	@endif
                </tbody>
          </table>
      </section>
    </div>
</div>
@endsection
@section('css_top')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('script_bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('.datepicker').datepicker({  
    format: 'mm-dd-yyyy'
  });  
  function filter() {
    var user = ($("#user").val() === '') ? '0' : $("#user").val();
    var action = ($("#action").val() === '') ? '0' : $("#action").val();
    var startdate = ($("#startdate").val() === '') ? '0' : $("#startdate").val();
    var enddate = ($("#enddate").val() === '') ? '0' : $("#enddate").val();
    if (startdate === "" || enddate === "") {
     startdate = "0";
     enddate = "0";
    }
    var start = startdate.replace(/\//g, "_");
    var end = enddate.replace(/\//g, "_");

    var url1 = "/manage-user-logs.html?user=" + encodeURIComponent(user) + "&action=" + encodeURIComponent(action) + "&startdate=" + encodeURIComponent(start) + "&enddate=" + end;
    window.location.href = url1;
  }
</script>
@endsection