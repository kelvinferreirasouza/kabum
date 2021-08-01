<div class="content-wrapper">
    <section class="content container-fluid">
        <form role="form" action="<?= URL . $this->controller . (isset($cliente) ? "/editarCliente/" . $cliente->id : "/adicionarCliente"); ?>" method="POST" class="frmChecaUsuario form-cad-usuario">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fas fa-user-plus icone-fa-right"></i> Cadastro de Cliente</h3>
                        </div>
                        <div class="box-body box-cadastro-cliente">
                            <div class="row">
                                <div class="dados_nome">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Nome</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="" class="form-control" name="nome" id="nome" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>CPF</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="cpf" id="cpf" cpf_mask autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4 col-lg-4">
                                    <label>RG <span class="obrigatorio"> <strong>*</strong></span></label>
                                    <input type="text" value="" class="form-control" id="rg" name="rg" data-mask autocomplete="off" required>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <label>Telefone</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="telefone" id="telefone" data-inputmask="'mask': '(99) 9999-9999'" data-mask autocomplete="off" required>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <label>Data de Nascimento</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control data" name="data_nascimento" id="data_nascimento" date-mask autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL . $this->controller; ?>"'><i class="fas fa-arrow-left icone-fa-right"></i> Voltar</button>
                            <div class="pull-right">
                                <button type="button" class="btn btn-block btn-primary btn-submit" name="cadastrar">Cadastrar <i class='fas fa-user-plus icone-fa-left'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>