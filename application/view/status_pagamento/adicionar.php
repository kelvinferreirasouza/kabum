<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form role="form" action="<?= URL . $this->rota . (isset($status_pagamento) ? '/editarStatus/' . $status_pagamento->id : '/adicionarStatus') ?>" method="POST" class="frmChecaUsuario">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="far fa-money-bill-alt icone-fa-right"></i><?= isset($status_pagamento) ? 'Editar' : 'Cadastrar' ?> <strong>Status de Pagamento</strong></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="nome">Nome: <span class="obrigatorio">*</span></label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($status_pagamento->nome) ? $status_pagamento->nome : '' ?>" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="nome">Cor: <span class="obrigatorio">*</span></label>
                                            <div class="input-group my-colorpicker2 colorpicker-element">
                                                <input type="text" class="form-control" placeholder="ex: #FFFF" name="cor" value="<?= isset($status_pagamento->cor) ? $status_pagamento->cor : ''; ?>" required>
                                                <div class="input-group-addon">
                                                    <i style="background-color: <?= isset($status_pagamento->cor) ? $status_pagamento->cor : '' ?>;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?= URL . $this->rota; ?>" class="btn btn-danger">Voltar <i class="fa fa-arrow-left icone-fa-left"></i></a>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-block btn-primary" name="cadastrar"><?= isset($status_pagamento) ? 'Atualizar <i class="fa fa-check icone-fa-left"></i>' : 'Cadastrar <i class="fa fa-floppy-o icone-fa-left"></i>' ?> </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>  