<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Usuário</h3>
                    </div>
                    <form role="form" action="<?= URL . $this->dir . "/editarCadatro" ?>" method="POST" class="frmChecaUsuario">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="nome">Nome <span class="obrigatorio">*</span></label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario->nome ?>" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="box-email">
                                        <label for="email">E-mail <span class="obrigatorio">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $usuario->email ?>" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="box-senha">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha">
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="box-senha">
                                        <label for="senha">Confirmação de Senha</label>
                                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL ?>"'>Voltar <i class="fa fa-arrow-left icone-fa-left"></i></button>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-block btn-primary" name="editar">Alterar <i class="fa fa-check icone-fa-left"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>