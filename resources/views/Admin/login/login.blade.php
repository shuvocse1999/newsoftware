
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <title>Admin || Login</title>
  <!-- GLOBAL MAINLY STYLES-->
  <link href="{{ url('public/Admin') }}/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ url('public/Admin') }}/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="{{ url('public/Admin') }}/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
  <!-- THEME STYLES-->
  <link href="{{ url('public/Admin') }}/assets/css/main.css" rel="stylesheet" />
  <!-- PAGE LEVEL STYLES-->
  <link href="{{ url('public/Admin') }}/assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-light" style="background:linear-gradient(0deg, rgba(14, 124, 63, 0.4), rgba(14, 124, 63, 0.4)), url({{ asset('public/admin/') }}/assets/img/bg.svg);  background-position: center; background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
  <div class="content">
    <form id="login-form" class="rounded-bottom" action="{{ route('admin.login') }}" method="post">
      @csrf
      <h2 class="login-title">Log in</h2>
      <div class="form-group">
        <label>Email:</label>
        <div class="input-group-icon right">
          <div class="input-icon"><i class="fa fa-envelope"></i></div>
          <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <div class="input-group-icon right">
          <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group d-flex justify-content-between">
        <label class="ui-checkbox ui-checkbox-info">
          <input type="checkbox">
          <span class="input-span"></span>Remember me</label>
          <a href="">Forgot password?</a>
        </div>
        <div class="form-group mt-4">
          <button class="btn btn-info btn-block" type="submit">Login</button>
        </div>

        
      </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
      <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{ url('public/Admin') }}/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="{{ url('public/Admin') }}/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{ url('public/Admin') }}/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{ url('public/Admin') }}/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ url('public/Admin') }}/assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
      $(function() {
        $('#login-form').validate({
          errorClass: "help-block",
          rules: {
            email: {
              required: true,
              email: true
            },
            password: {
              required: true
            }
          },
          highlight: function(e) {
            $(e).closest(".form-group").addClass("has-error")
          },
          unhighlight: function(e) {
            $(e).closest(".form-group").removeClass("has-error")
          },
        });
      });
    </script>

    <style type="text/css">
     .login-title{
      font-weight: bold;

    }

    .form-control{
      height: 40px;
    }
    label{
      font-size: 13px;
    }

    .btn-block{
      cursor: pointer;
    }
    .content{
      margin-top: 150px;
      margin-bottom: 150px;
      border-top: 4px solid #23B7E5;
    }


  </style>


</body>
</html>


