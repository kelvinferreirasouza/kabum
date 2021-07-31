<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ops - Recuperar Senha</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/bootstrap.min.css" ?>">
    <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/font-awesome.min.css" ?>">
    <link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/AdminLTE.min.css" ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?= URL . 'img/logos/logo.png' ?>">
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Informe o email de acesso</p>
            <form action="<?= URL; ?>login/codigorecuperacao" method="post" class="frmChecaUsuario">
                <div class="form-group box-email">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-danger btn-flat" onclick='location.href ="<?= URL . "login/" ?>"'>Cancelar</button>
                    <div class="pull-right">
                        <button type="submit" name="enviar" class="btn btn-success btn-block btn-flat">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var email_incorreto = "<?php if (isset($_GET['emailincorreto'])) {
                                    echo $_GET['emailincorreto'];
                                } ?>";
    </script>
    <script src="<?= URL . "js/" . VERSAO . "/jquery.min.js" ?>"></script>
    <script src="<?= URL . "js/" . VERSAO . "/bootstrap.min.js" ?>"></script>
    <script src="<?= URL . "js/" . VERSAO . "/adminlte.min.js" ?>"></script>
    <script src="<?= URL . "js/" . VERSAO . "/login.js" ?>"></script>
</body>

</html>