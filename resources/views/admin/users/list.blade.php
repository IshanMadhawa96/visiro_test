
@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users List  (Total:{{ $getRecord->total() }}) </h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/users/add') }}" class="btn btn-primary">Add new User</a>
          </div>


        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Users</h3>
                  </div>
                <form method="get" action="{{ url('admin/users/list') }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label >Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}"  placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label >Email</label>
                                <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}"   placeholder="Email">
                                <div style="color:red">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>User Type</label>
                                <select class="form-control" name="user_type">
                                    <option {{ (Request::get('user_type') == 1) ? 'selected' : '' }} value="1">Admin</option>
                                    <option {{ (Request::get('user_type') == 2) ? 'selected' : '' }} value="2">CRM</option>
                                    <option {{ (Request::get('user_type') == 3) ? 'selected' : '' }} value="3">PayRoll</option>
                                    <option {{ (Request::get('user_type') == 4) ? 'selected' : '' }} value="4">HR</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label >Date</label>
                                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}"   placeholder="Date">
                                <div style="color:red">{{ $errors->first('date') }}</div>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 30px">Search</button>
                                <a href="{{ url('admin/users/list') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('_message')
            <div class="card">
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($getRecord) > 0)
                        @foreach ($getRecord as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    @if( $value->user_type == 1)
                                        Admin
                                    @elseif( $value->user_type == 2)
                                        CRM
                                    @elseif( $value->user_type == 3)
                                        PayRoll
                                    @elseif( $value->user_type == 4)
                                        HR
                                    @endif
                                </td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a href="{{ url('admin/users/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('admin/users/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No records found</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
                <div style="padding:10px; float:right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
