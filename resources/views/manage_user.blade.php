@extends('layouts.master')
@section('content')
<div class="col-lg-12">
  	<!--breadcrumbs start -->
  	<div class="row">
	  <ul class="breadcrumb">
	      <li><a href="/welcome.html"><i class="fa fa-home"></i> Home</a></li>
	      <li><a href="/manage-user.html">Admin</a></li>
	      <li class="active">Danh sách Admin</li>
	  </ul>
	</div>
  	<!--breadcrumbs end -->
  	<div class="row">
        <section class="panel">
            <header class="panel-heading">
                  Có tổng số <font color="red">{{ $data['TotalUser'] }}</font> tài khoản admin
            </header>
            <table class="table table-striped table-advance table-hover">
                  <thead>
                  <tr>
                      <th><i class="fa fa-bullhorn"></i> ID</th>
                      <th class="hidden-phone"><i class="fa fa-question-circle"></i> Name</th>
                      <th><i class="fa fa-bookmark"></i> Email</th>
                      <th><i class=" fa fa-edit"></i> Is Root</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
					@if(isset($data['AllUser']) && $data['AllUser'])
					@foreach($data['AllUser'] as $user)
                  	<tr>
                      <td>
                          <a href="#">
                              {{ $user->id }}
                          </a>
                      </td>
                      <td class="hidden-phone">{{ $user->name }}</td>
                      <td>{{ $user->email }} </td>
                      <td><span class="label label-warning label-mini">{{ $user->is_root }}</span></td>
                      <td>
                          <a href="manage-user/add-user.html" title="Thêm mới" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                          <a href="manage-user/edit-user/{{ $user->id }}.html" title='Cập nhật' class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                          <a onclick="return confirm('Bạn có chắc xóa user này không?');" href="manage-user/delete-user/{{ $user->id }}.html" title="Xóa" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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