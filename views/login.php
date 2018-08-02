<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PainelCampanha | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>PAC</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="?controller=CtrlLogin&action=LoginUsuario" id="loginform" class="form-horizontal" role="form" method="post">
          <div class="form-group has-feedback">
              <input id="usuario" type="text" class="form-control required" onkeyup="cpfcnpj()" maxlength="18" name="cpfCnpj" value="" placeholder="CPF/CNPJ"
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input id="senha" type="password" class="form-control" name="senha" placeholder="Senha">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Lembrar
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div><!-- /.col -->
          </div>
        </form>

        
        </div><!-- /.social-auth-links -->

        <a href="#">Esqueci minha senha</a><br>
        <a href="register.html" class="text-center">Novo membro</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      
      function cpfcnpj(){
		if($("#usuario").val().length == 3){
		$("#usuario").val($("#usuario").val() + '.');
		return false;
	}
	if($("#usuario").val().length == 7){
		$("#usuario").val($("#usuario").val() + '.');
		return false;
	}
	if($("#usuario").val().length == 11){
		$("#usuario").val($("#usuario").val() + '-');
		return false;
	}
	if($("#usuario").val().length == 15){
		p0=$("#usuario").val().charAt(0);
		p1=$("#usuario").val().charAt(1);
		p2=$("#usuario").val().charAt(2);
		p3=$("#usuario").val().charAt(4);
		p4=$("#usuario").val().charAt(5);
		p5=$("#usuario").val().charAt(6);
		p6=$("#usuario").val().charAt(8);
		p7=$("#usuario").val().charAt(9);
		p8=$("#usuario").val().charAt(10);
		p9=$("#usuario").val().charAt(12);
		p10=$("#usuario").val().charAt(13);
		p11=$("#usuario").val().charAt(14);
		$("#usuario").val('');
		$("#usuario").val(p0 + p1 + '.' + p2 + p3 + p4 + '.' + p5 + p6 + p7 + '/' + p8 + p9 + p10 + p11 + '-');
		p0='';
		p1='';
		p2='';
		p3='';
		p4='';
		p5='';
		p6='';
		p7='';
		p8='';
		p9='';
		p10='';
		p11='';
		return false;
	}
}
    </script>
  </body>
</html>


