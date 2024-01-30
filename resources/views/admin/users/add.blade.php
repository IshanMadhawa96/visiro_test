
@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new User</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="{{ url('admin/users/add') }}">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Name</label>
                    <input type="name" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Name">
                    <div style="color:red">{{ $errors->first('name') }}</div>
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required  placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label >User Type</label>
                    <select class="form-control" name="user_type">
                        <option {{ (old('user_type') == 1) ? 'selected' : '' }} value="1">Admin</option>
                        <option {{ (old('user_type') == 2) ? 'selected' : '' }} value="2">CRM</option>
                        <option {{ (old('user_type') == 3) ? 'selected' : '' }} value="3">PayRoll</option>
                        <option {{ (old('user_type') == 4) ? 'selected' : '' }} value="4">HR</option>
                    </select>
                    <div style="color:red">{{ $errors->first('user_type') }}</div>
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                    <div style="color:red">{{ $errors->first('password') }}</div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
