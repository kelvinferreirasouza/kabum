<?php

if (!isset($_GET['url']) || empty($_GET['url'])) {
  $_GET['pg'] = "home";
}

$arrRoute = explode('/', $_GET['url']);
$_GET['pg'] = isset($arrRoute[0]) ? $arrRoute[0] : null;
$_GET['pg2'] = isset($arrRoute[1]) ? $arrRoute[1] : null;
$_GET['pg3'] = isset($arrRoute[2]) ? $arrRoute[2] : null;
$_GET['pg4'] = isset($arrRoute[3]) ? $arrRoute[3] : null;
$_GET['pg5'] = isset($arrRoute[4]) ? $arrRoute[4] : null;
$_GET['pg6'] = isset($arrRoute[5]) ? $arrRoute[5] : null;
$_GET['pg7'] = isset($arrRoute[6]) ? $arrRoute[6] : null;
$_GET['pg8'] = isset($arrRoute[7]) ? $arrRoute[7] : null;
$_GET['pg9'] = isset($arrRoute[8]) ? $arrRoute[8] : null;
$_GET['pg10'] = isset($arrRoute[9]) ? $arrRoute[9] : null;
$_GET['pg11'] = isset($arrRoute[10]) ? $arrRoute[10] : null;
$_GET['pg12'] = isset($arrRoute[11]) ? $arrRoute[11] : null;

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $this->config_sistema->titulo; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="imagem/png" href="<?= URL . 'img/logos/favicon.png' ?>" />
  <?= $this->renderStyle() ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">
    <header class="main-header">
      <a href="#" class="logo">
        <div class="row">
          <img class="logo-mini" src="<?= URL . 'img/logos/mini.png' ?>">
          <img class="logo-lg" src="<?= URL . 'img/logos/logo_menu.png' ?>">
        </div>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?= $_SESSION['kabum']['nome'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header" style="height: 100px">
                  <p>
                    <?= $_SESSION['kabum']['nome'] ?>
                    <br>
                    <small><?= $_SESSION['kabum']['email'] ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?= URL ?>login/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sair</a>
                  </div>
                  <div class="pull-left">
                    <a href="<?= URL ?>usuarios/meuCadastro" class="btn btn-default btn-flat"><i class="fas fa-user icone-fa-right"></i> Meu Cadastro</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <?php if (isset($this->paginas) && count($this->paginas) >= 1) : ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">GERENCIAMENTO</li>

            <?php foreach ($this->paginas as $pagina) : ?>
              <li class="pagina <?= count($this->menu->getSubmenuByMenu($pagina->id_menu)) >= 1 ? 'treeview' : ''; ?>">
                <a id="<?= $pagina->id_menu; ?>" href="<?= URL . $pagina->rota ?>">
                  <i class="<?= $pagina->icone; ?> icone-fa-right"></i>
                  <span><?= $pagina->nome; ?></span>

                  <?php if (count($this->menu->getSubmenuByMenu($pagina->id_menu)) >= 1) : ?>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  <?php endif; ?>
                </a>

                <?php if (count($this->menu->getSubmenuByMenu($pagina->id_menu)) >= 1) : ?>
                  <ul class="treeview-menu">
                    <?php foreach ($this->menu->getSubmenuByMenu($pagina->id_menu) as $submenu) : ?>
                      <li class="pagina">
                        <?php $pagina_href = URL . $submenu->rota; ?>
                        <a id="<?= $submenu->id_menu; ?>" href="<?= $pagina_href; ?>">
                          <i class="<?= $submenu->icone; ?> icone-fa-right"></i>
                          <span><?= $submenu->nome; ?></span>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </section>
    </aside>