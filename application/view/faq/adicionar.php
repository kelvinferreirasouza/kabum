<div class="content-wrapper">
    <section class="content container-fluid">
        <form role="form" action="<?= URL . $this->controller . (isset($obj) ? "/update/" . $obj->id : "/insert"); ?>" method=" POST" class="frmChecaUsuario">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registrar Pergunta Frequente</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <label for="pergunta">Pergunta Frequente</label>
                                <textarea name="pergunta" class=" form-control" id="pergunta" rows="8" required><?= isset($obj) ? $obj->pergunta : '' ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="resposta">Resposta</label>
                                <textarea name="resposta" class="form-control" id="resposta" rows="8" required><?= isset($obj) ? $obj->resposta : '' ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL . $this->controller; ?>"'>Voltar</button>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-block btn-primary btn_valida_item" name="registrar"><?= (isset($obj) ? "Salvar" : "Cadastrar"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>