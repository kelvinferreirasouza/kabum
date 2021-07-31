<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kabum - Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/bootstrap.min.css" ?>">
  <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/font-awesome.min.css" ?>">
  <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/AdminLTE.min.css" ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="<?= URL . 'img/logos/logo.png' ?>">
    </div>
    <div class="login-box-body">
      <div class="box-msg text-center"></div>
      <p class="login-box-msg">Faça login para acessar o sistema</p>

      <form action="<?= URL; ?>login/logar" method="post" class="frmChecaUsuario noMargin">
        <div class="form-group box-email box-erro">
          <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="form-group box-senha">
          <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" name="login" class="btn btn-success btn-block btn-flat">Entrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    var dados_incorretos = "<?= isset($_GET['dadosincorretos']) ? $_GET['dadosincorretos'] : '' ?>";
  </script>

  <script src="<?= URL . "js/" . VERSAO . "/jquery.min.js" ?>"></script>
  <script src="<?= URL . "js/" . VERSAO . "/bootstrap.min.js" ?>"></script>
  <script src="<?= URL . "js/" . VERSAO . "/adminlte.min.js" ?>"></script>
  <script src="<?= URL . "js/" . VERSAO . "/login.js" ?>"></script>
</body>

</html>