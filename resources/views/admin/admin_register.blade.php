
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Contact us</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin_lte/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
  <div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Login</h1>
          </div>
          <div class="col-sm-6">
          
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-6 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2><strong>Admin</strong>Login</h2>
              <p class="lead mb-5">Contact us<br>
                Phone: +91 868 650 1615 
              </p>
            </div>
          </div>
          <div class="col-6">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Opps!</strong> {{session::get('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
           @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Good bye!</strong> {{session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{route('admin.register')}}" method="post">
            @csrf
                        <div class="form-group">
                                          <label for="inputName">Name</label>
               <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Full Name">


               @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group">
              <label for="inputEmail">Email</label>
               <input type="text" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="inputConfirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="inputConfirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Confirm Password" />
                @error('confirmPassword')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Register">
                        <a href="{{ route('admin_login_form') }}">Login</a>

            </div>
        </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin_lte/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_lte/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
