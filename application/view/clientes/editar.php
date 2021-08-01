<?php

use Kabum\libs\Util;

?>

<!-- ARQUIVOS NECESSÁRIOS PARA O TOAST FUNCIONAR! -->
<link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/toastr.min.css" ?>">
<script src="<?= URL . "js/" . VERSAO . "/jquery.min.js" ?>"></script>
<script src="<?= URL . "js/" . VERSAO . "/toastr.min.js" ?>"></script>

<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary form-group">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fas fa-user-plus icone-fa-right"></i> Cadastro de Cliente</h3>
                    </div>
                    <div class="box-body box-cadastro-cliente">
                        <div class="row">
                            <form role="form" action="<?= URL . $this->controller . (isset($cliente) ? "/editarCliente/" . $cliente->id : "/adicionarCliente"); ?>" method="POST" class="frmChecaUsuario form-cad-usuario">
                                <div class="dados_nome">
                                    <div class="form-group col-md-4 col-lg-4">
                                        <label>Nome</label><span class="obrigatorio"> <strong>*</strong></span>
                                        <input type="text" value="<?= isset($cliente) ? $cliente->nome : ""; ?>" class="form-control" name="nome" id="nome" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>CPF</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($cliente) ? $cliente->cpf : ""; ?>" class="form-control" name="cpf" id="cpf" cpf_mask autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4 col-lg-4">
                                    <label>RG <span class="obrigatorio"> <strong>*</strong></span></label>
                                    <input type="text" value="<?= isset($cliente) ? $cliente->rg : ""; ?>" class="form-control" id="rg" name="rg" data-mask autocomplete="off" required>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <label>Telefone</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($cliente) ? $cliente->telefone : ""; ?>" class="form-control" name="telefone" id="telefone" data-inputmask="'mask': '(99) 9999-9999'" data-mask autocomplete="off" required>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <label>Data de Nascimento</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="<?= isset($cliente) ? $cliente->data_nascimento : ""; ?>" class="form-control data" name="data_nascimento" id="data_nascimento" date-mask autocomplete="off" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL . $this->controller; ?>"'><i class="fas fa-arrow-left icone-fa-right"></i> Voltar</button>
                        <div class="pull-right">
                            <button type="button" class="btn btn-block btn-primary btn-submit" name="cadastrar"><?= (isset($cliente) ? "Salvar <i class='fas fa-user-plus icone-fa-right'></i>" : "Cadastrar <i class='fas fa-user-plus icone-fa-left'></i>"); ?></button>
                        </div>
                    </div>
                </div>

                <div class="box box-primary form-group collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title box-title-endereco"><i class="fas fa-map-marked-alt icone-fa-right"></i> Cadastrar Endereço</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body box-cadastro-endereco">
                        <div class="row">
                            <form role="form" action="<?= URL . $this->controller . "/adicionarEndereco/" . $cliente->id; ?>" method="POST" class="frmChecaUsuario form-cad-endereco" id="form-cad-end">
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>CEP</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="cep" id="cep" data-inputmask="'mask': '99999-999'" data-mask autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Estado <span class="obrigatorio"> <strong>*</strong></span></label>
                                    <select class="form-control selectEstado" id="estado" name="estado" required>
                                        <?php foreach ($estados as $estado) : ?>
                                            <option value="<?= $estado->uf; ?>"><?= $estado->nome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Cidade <span class="obrigatorio"> <strong>*</strong></span></label>
                                    <select class="form-control selectCidade" id="cidade" name="cidade" required></select>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label>Endereço</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="endereco" id="endereco" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label>Número</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="numero_endereco" id="numero_endereco" autocomplete="off" onkeypress='return somenteNumeros(event)' required>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label>Bairro</label><span class="obrigatorio"> <strong>*</strong></span>
                                    <input type="text" value="" class="form-control" name="bairro" id="bairro" autocomplete="off" required>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label>Complemento</label>
                                    <input type="text" value="" class="form-control" name="complemento" id="complemento" autocomplete="off">
                                </div>

                                <input type="hidden" name="id_cliente" id="id_cliente" value="<?= $id_cliente ?>">
                            </form>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-block btn-primary btn-submit-end" name="cadastrar">Cadastrar <i class='fas fa-user-plus icone-fa-left'></i></button>
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fas fa-map-marker-alt icone-fa-right"></i> Endereços Cadastrados</h3>
                    </div>
                    <div class="box-body box-listagem-enderecos">
                        <table class="table table-bordered table-striped" id="tabela-enderecos">
                            <thead>
                                <th>Endereço</th>
                                <th>Cidade / Estado</th>
                                <th>CEP</th>
                                <th class="td-acoes">Ações</th>
                            </thead>
                            <tbody class="enderecos">
                                <?php if (COUNT($cliente_enderecos) > 0) { ?>
                                    <?php foreach ($cliente_enderecos as $endereco) { ?>
                                        <tr class="endereco_<?= $endereco->id ?>">
                                            <td><?= $endereco->endereco . ", " . $endereco->numero . ($endereco->complemento != '' ? ' - ' . $endereco->complemento : '') ?></td>
                                            <td><?= Util::normalizaExibicaoStrings($endereco->nome_cidade) . " / " . $endereco->uf_estado  ?></td>
                                            <td><?= Util::maskCep($endereco->cep) ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <a class="btn-circle btn-primary btn-editar-endereco" data-id="<?= $endereco->id ?>"><i class="fa fa-pencil"></i></a>
                                                    <a class="btn-circle btn-danger btn-excluir-endereco" data-id="<?= $endereco->id ?>"><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center tr-nenhum-end" colspan="7">Nenhum endereço cadastrado.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>

<?php if (isset($_GET['cadastrado']) && $_GET['cadastrado'] == 'true') { ?>
    <script>
        toastSucessMessage('Cliente cadastrado com sucesso!');
    </script>
<?php } ?>