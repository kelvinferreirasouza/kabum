<div class="content-wrapper">
    <section class="content container-fluid">
        <form role="form" action="<?= URL . $this->controller . (isset($obj) ? "/editarCliente/" . $obj->id : "/adicionarCliente"); ?>" method="POST" class="frmChecaUsuario">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= (isset($obj) ? "Editar Cliente" : "Cadastrar Cliente"); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label>Tipo de Cliente:</label>
                                    <div class="radio">
                                        <?php foreach ($tiposCliente as $tipo) { ?>
                                            <label class="label-radio-tipo-cliente">
                                                <input class="id_tipo_cliente" <?= ((isset($obj) && $tipo->id == $obj->id_fisica_juridica) || (!isset($obj) && $tipo->id == 1) ? "checked" : ""); ?> type="radio" name="id_tipo_cliente" id="" value="<?= $tipo->id; ?>">
                                                <?= $tipo->nome; ?>
                                            </label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados Cadastrais</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="dados_nome">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Nome</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="<?= isset($obj) ? $obj->nome : ""; ?>" class="form-control" name="nome" id="nome" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>CPF/CNPJ</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->cpf_cnpj : ""; ?>" class="form-control" name="cpf_cnpj" id="cpf_cnpj" cpfcnpj_mask autocomplete="off" required>
                                </div>

                                <?php if (isset($obj)) { ?>
                                    <input type="hidden" value="<?= $obj->cpf_cnpj; ?>" id="cpf_cnpj_saved" />
                                <?php } ?>

                                <div class="form-group col-md-4 col-lg-4">
                                    <label>RG/IE</label>
                                    <input type="text" value="<?= isset($obj) ? $obj->rg_ie : ""; ?>" class="form-control" id="rg_ie" name="rg_ie" data-mask autocomplete="off">
                                </div>
                                <div class="dados_pessoa_juridica">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Razão Social</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="<?= isset($obj) ? $obj->razao_social : ""; ?>" class="form-control" name="nome_empresa" id="nome_empresa" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Nome do Responsável pela Empresa</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="<?= isset($obj) ? $obj->nome_responsavel : ""; ?>" class="form-control" name="nome_responsavel_empresa" id="nome_responsavel_empresa" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>CPF do Responsável pela Empresa</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="<?= isset($obj) ? $obj->cpf_responsavel : ""; ?>" cpf_mask class="form-control" name="cpf_responsavel_empresa" id="cpf_responsavel_empresa" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>E-mail</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="email" value="<?= isset($obj) ? $obj->email : ""; ?>" class="form-control" name="email" id="email" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-3 col-lg-3">
                                    <label>Telefone</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->telefone : ""; ?>" class="form-control" name="telefone" id="telefone" data-inputmask="'mask': '(99) 9999-9999'" data-mask autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-3 col-lg-3">
                                    <label>Celular</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->celular : ""; ?>" class="form-control" name="celular" id="celular" data-inputmask="'mask': '(99) 9 9999-9999'" data-mask autocomplete="off" required>
                                </div>
                                <?php if (isset($obj)) { ?>
                                    <div class="col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="ativo">Ativo</label>
                                            <select name="ativo" class="form-control">
                                                <?php if ($obj->ativo == true) : ?>
                                                    <option value="1" selected="selected">Ativo</option>
                                                    <option value="0">Inativo</option>
                                                <?php else : ?>
                                                    <option value="0" selected="selected">Inativo</option>
                                                    <option value="1">Ativo</option>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="box-header with-border only-padding-bottom form-group">
                                <h3 class="box-title"><i class="fas fa-map-marker-alt icone-fa-right"></i>Dados de <strong>Endereço</strong></h3>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 col-lg-3">
                                    <label>CEP</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->cep : ""; ?>" class="form-control" name="cep" id="cep" data-inputmask="'mask': '99999-999'" data-mask autocomplete="off" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Estado</label>
                                    <select class="form-control selectEstado" id="estado" name="estado">
                                        <?php foreach ($estados as $estado) : ?>
                                            <option <?= (isset($obj) && $estado->uf == $uf_estado->uf) ? 'selected' : ''; ?> value="<?= $estado->uf; ?>"><?= $estado->nome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Cidade</label>
                                    <select class="form-control selectCidade" id="cidade" name="cidade"></select>
                                </div>
                                <?php if (isset($obj)) { ?>
                                    <input type="hidden" value="<?= $obj->id_cidade; ?>" id="id_cidade_saved" />
                                <?php } ?>
                                <div class="col-md-3">
                                    <label>Bairro</label>
                                    <select class="form-control selectBairro" id="bairro" name="bairro"></select>
                                </div>
                                <?php if (isset($obj)) { ?>
                                    <input type="hidden" value="<?= $obj->id_bairro; ?>" id="id_bairro_saved" />
                                <?php } ?>
                                <div class="form-group col-md-10 col-lg-10">
                                    <label>Endereço</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->endereco : ""; ?>" class="form-control" name="endereco" id="endereco" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-2 col-lg-2">
                                    <label>Número</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($obj) ? $obj->numero_endereco : ""; ?>" class="form-control" name="numero_endereco" id="numero_endereco" autocomplete="off" onkeypress='return somenteNumeros(event)' required>
                                </div>
                            </div>

                            <div class="box-header with-border only-padding-bottom">
                                <h3 class="box-title"><i class="fa fa-user icone-fa-right"></i>Usuário Responsável</h3>
                            </div>
                            <div class="only-padding-top form-group">
                                <div class="row">
                                    <div class="form-group col-md-3 col-lg-3">
                                        <label>Senha</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="password" value="" class="form-control" name="senha_usuario" id="senha_usuario" autocomplete="off" <?= isset($obj) ? "" : "required"; ?>>
                                    </div>
                                    <div class="form-group col-md-3 col-lg-3">
                                        <label>Confirmar Senha</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="password" value="" class="form-control" name="confirmar_senha_usuario" id="confirmar_senha_usuario" autocomplete="off" <?= isset($obj) ? "" : "required"; ?>>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL . $this->controller; ?>"'>Voltar</button>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-block btn-primary btn_valida_item" name="cadastrar"><?= (isset($obj) ? "Salvar" : "Cadastrar"); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>