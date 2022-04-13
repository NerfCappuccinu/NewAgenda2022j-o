<?php
ob_start(); //Armazena meus dados em cache
session_start(); //Inicia a sessão
if(isset($_SESSION['emailUser'])&&(isset($_SESSION['senhaUser']))){
header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda JMF | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Agenda</b>JMF</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça login para cadastrar os contatos</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Digite seu E-mail..." name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Digite sua senha..." name="senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button name="btnlogin" type="submit" class="btn btn-primary btn-block">Acessar Agenda</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
      include_once('config/conexao.php');
      if(isset($_POST['btnlogin'])){
        $email=$_POST['email'];
        $senha=$_POST['senha'];
        $select="SELECT * FROM tb_user WHERE email_user=:emailLogin AND senha_user=:senhaLogin";
        try{
          $resultLogin = $conect->prepare($select);
          $resultLogin->BindParam(':emailLogin',$email, PDO::PARAM_STR);
          $resultLogin->BindParam(':senhaLogin',$senha, PDO::PARAM_STR);
          $resultLogin->execute();

          $verificar = $resultLogin->rowCount();
          if($verificar>0){
            $email=$_POST['email'];
            $senha=$_POST['senha'];
            //CRIAR SESSAO »»
            $_SESSION['emailUser']= $email;
            $_SESSION['senhaUser']= $senha;

            echo "Você será redirecionado a agenda )";
            header("Refresh: 3, home.php");
        }else{
          echo "E-mail ou senha incorretos";
        }
        }catch(PDOException $e){
          echo "<strong>ERRO DE LOGIN = </strong>".$e->getMessage();
        }
      }
      ?>

      
      <!-- /.social-auth-links -->

      
      <p style="margin-top:20px; text-align:center" class="mb-0">
        <a href="registro.php" class="text-center">Cadastro para novo usuário</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
