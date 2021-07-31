<?php

use Kabum\libs\Util;

?>

<!-- ARQUIVOS NECESSÁRIOS PARA O TOAST FUNCIONAR! -->
<link rel="stylesheet" href="<?= URL . "css/" . VERSAO . "/toastr.min.css" ?>">
<script src="<?= URL . "js/" . VERSAO . "/jquery.min.js" ?>"></script>
<script src="<?= URL . "js/" . VERSAO . "/toastr.min.js" ?>"></script>

<div class="content-wrapper">
    <section class="content container-fluid">
        <form role="form" action="<?= URL ?>configuracoes/updateConfiguracoesGerais" method="POST">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Configurações do Sistema</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="titulo">Título do Sistema</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" value="<?= $config->titulo ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="rodape">Rodapé do Sistema</label>
                            <input type="text" class="form-control" d="rodape" name="rodape" value="<?= $config->rodape ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Configurações ChatBot</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="msg">Mensagem Automática</label>
                            <textarea name="msg" class="form-control" id="msg" rows="8" cols="33"><?= $chatbot->mensagem_automatica; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Configurações de E-mail</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Host</label>
                            <input class="form-control" type="text" name="host" id="host" value="<?= isset($config_email->host) ? $config_email->host : "" ?>" required autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Porta</label>
                            <input class="form-control" type="text" name="porta" id="porta" value="<?= isset($config_email->port) ? $config_email->port : "" ?>" required autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label>Segurança</label>
                            <select name="seguranca">
                                <option value="1" <?= isset($config_email) && $config_email->security == 1 ? "selected" : ""; ?>>STTRL</option>
                                <option value="0" <?= isset($config_email) && $config_email->security == 0 ? "selected" : ""; ?>>SSL</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input class="form-control" type="text" name="email_automatico" id="email_automatico" value="<?= isset($config_email->email) ? $config_email->email : "" ?>" required autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input class="form-control" type="password" name="password" id="password" value="<?= isset($config_email->password) ? $config_email->password : "" ?>" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Configurações Edmond</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Token Produção</label>
                            <input class="form-control" type="text" name="token_producao" id="token_producao" value="<?= isset($config_edmond->token_producao) ? $config_edmond->token_producao : "" ?>" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Token Homologação</label>
                            <input class="form-control" type="text" name="token_homologacao" id="token_homologacao" value="<?= isset($config_edmond->token_homologacao) ? $config_edmond->token_homologacao : "" ?>">
                        </div>
                        <div class="form-group col-md-5">
                            <label>URL Produção</label>
                            <input class="form-control" type="text" name="url_producao" id="url_producao" value="<?= isset($config_edmond->url_producao) ? $config_edmond->url_producao : "" ?>" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-5">
                            <label>URL Homologação</label>
                            <input class="form-control" type="text" name="url_homologacao" id="url_homologacao" value="<?= isset($config_edmond->url_homologacao) ? $config_edmond->url_homologacao : "" ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label>ID Estabelecimento</label>
                            <input class="form-control" type="text" name="id_estabelecimento" id="id_estabelecimento" value="<?= isset($config_edmond->id_estabelecimento) ? $config_edmond->id_estabelecimento : "" ?>" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="descricao_link">Descrição Padrão</label>
                            <textarea name="descricao_link" class="form-control" id="descricao_link" rows="8" cols="33"><?= $config_edmond->descricao_link; ?></textarea>
                        </div>
                        <div class="form-group col-md-10">
                            <label>Titulo Padrão</label>
                            <input class="form-control" type="text" name="titulo_link" id="titulo_link" value="<?= isset($config_edmond->titulo_link) ? $config_edmond->titulo_link : "" ?>" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Prazo Pagamento</label>
                            <select name="qtd_dias_link_valido" id="qtd_dias_link_valido">
                                <?php
                                for ($contador = 1; $contador < 11; $contador++) {
                                ?>
                                    <option <?= $config_edmond->qtd_dias_link_valido == $contador ? $contador . " selected" : $contador; ?>><?= $contador ?> Dias úteis</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Regras de Pagamento</h4>
                </div>
                <div class="box-body">
                    <div class="box-header with-border" style="padding: 10px 0px 10px 0px;">
                        <h3 class="box-title">Franquia</h3>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <label for="">Valor Mínimo (R$)</label>
                            <input type="text" data-mask-money class="form-control" id="valor_minimo_franquia" name="valor_minimo_franquia" value="<?= Util::maskMoney($pagamento_franquia->valor_minimo); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="valor_minimo_franquia">Percentual Padrão (%)</label>
                            <input type="text" percent-mask class="form-control" id="percentual_padrao_franquia" name="percentual_padrao_franquia" value="<?= $pagamento_franquia->percentual_padrao; ?>">
                        </div>
                    </div>
                    <div class="box-header with-border" style="padding: 10px 0px 10px 0px;  margin-top: 15px;">
                        <h4 class="box-title">Profissional</h4>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <label for="valor_minimo_profissional">Valor Mínimo (R$)</label>
                            <input type="text" data-mask-money class="form-control" id="valor_minimo_profissional" name="valor_minimo_profissional" value="<?= Util::maskMoney($pagamento_profissional->valor_minimo); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="">Percentual Padrão (%)</label>
                            <input type="text" percent-mask class="form-control" id="percentual_padrao_profissional" name="percentual_padrao_profissional" value="<?= $pagamento_profissional->percentual_padrao; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6" style="padding-right: 0px;">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">Juros Parcelamento (%) - Negociação Fechada</h4>
                        </div>
                        <div class="box-body">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <?php for ($i = 1; $i <= 12; $i++) {
                                        $string = 'parcela' . floatval($i); ?>
                                        <label class="col-md-6" for=""><?= $i ?>º Parcela - Taxa Parcelamento</label>
                                        <input class="col-md-6" percent-mask type="text" class="form-control" id="juros_fechada" name="fechada<?= $i ?>" value="<?= $taxas_negociacao_fechada->$string; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6" style="padding-right: 0px;">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">Juros Parcelamento (%) - Negociação Chat</h4>
                        </div>
                        <div class="box-body">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <?php for ($i = 1; $i <= 12; $i++) {
                                        $string = 'parcela' . floatval($i); ?>
                                        <label class="col-md-6" for=""><?= $i ?>º Parcela - Taxa Parcelamento</label>
                                        <input class="col-md-6" percent-mask type="text" class="form-control" id="juros_chat" name="chat<?= $i ?>" value="<?= $taxas_negociacao_chat->$string; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">Dados da Empresa</h4>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-md-2 col-lg-2">
                                    <label>CNPJ</label><span class="obrigatorio"> *</span>
                                    <input class="form-control" type="text" name="cnpj" id="cnpj" value="<?= isset($config_empresa->cnpj) ? $config_empresa->cnpj : "" ?>" cnpj_mask required placeholder="ex: 99.999.999/9999-99" autocomplete="off">
                                </div>
                                <div class="form-group col-md-2 col-lg-2">
                                    <label>IE</label><span class="obrigatorio"> *</span>
                                    <a aria-hidden="true" class="btn-isento pull-right cursor-pointer">Isento</a>
                                    <input class="form-control" type="text" name="ie" id="ie" value="<?= isset($config_empresa->ie) ? $config_empresa->ie : "" ?>" required autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>Razão Social</label><span class="obrigatorio"> *</span>
                                    <input class="form-control" type="text" name="razao_social" id="razao_social" value="<?= isset($config_empresa->razao_social) ? $config_empresa->razao_social : "" ?>" required autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>Nome Fantasia</label><span class="obrigatorio"> *</span>
                                    <input class="form-control" type="text" name="nome_fantasia" id="nome_fantasia" value="<?= isset($config_empresa->nome_fantasia) ? $config_empresa->nome_fantasia : "" ?>" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-lg-2">
                            <label>Telefone Fixo</label><span class="obrigatorio"> *</span>
                            <input class="form-control" type="text" name="telefone" fone_mask value="<?= isset($config_empresa->telefone) ? $config_empresa->telefone : "" ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-md-2 col-lg-2">
                            <label>Celular</label>
                            <input class="form-control" type="text" name="celular" celular_mask value="<?= isset($config_empresa->celular) ? $config_empresa->celular : "" ?>" autocomplete="off">
                        </div>

                        <div class="form-group col-md-4 col-lg-4">
                            <label>Email</label><span class="obrigatorio"> *</span>
                            <input class="form-control" type="email" name="email" id="email" value="<?= isset($config_empresa->email) ? $config_empresa->email : "" ?>" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-2 col-lg-2">
                            <label>CEP</label><span class="obrigatorio"> *</span>
                            <input class="form-control" type="text" id="cep" name="cep" value="<?= isset($config_empresa->cep) ? $config_empresa->cep : "" ?>" required cep_mask autocomplete="off" onchange="cep(this)" required>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <label>Estado</label><span class="obrigatorio"> *</span>
                            <select class="form-control" name="estado" id="estado" required>
                                <?php foreach ($estados as $estado) : ?>
                                    <option value="<?= $estado->uf; ?>" <?= ((isset($config_empresa->id_estado) ? $config_empresa->id_estado : "") == $estado->id) ? "selected" : ""; ?>><?= $estado->nome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <label>Cidade</label><span class="obrigatorio"> *</span>
                            <?php if (isset($config_empresa->id_cidade)) { ?>
                                <select class="form-control" name="id_cidade" id="cidade" required>
                                    <?php foreach ($cidades as $cidade) { ?>
                                        <option value="<?= $cidade->id ?>" <?= $cidade->id == $config_empresa->id_cidade ? 'selected="selected"' : '' ?>><?= $cidade->nome ?></option>
                                    <?php }  ?>
                                </select>
                            <?php } else { ?>
                                <select class="form-control" name="id_cidade" id="cidade" required>
                                </select>
                            <?php }  ?>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nome">Endereço</label><span class="obrigatorio"><strong> *</strong></span>
                                <input class="form-control" type="text" id="endereco" name="endereco" value="<?= isset($config_empresa->endereco) ? $config_empresa->endereco : "" ?>" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="nome">Número</label><span class="obrigatorio"> <strong> *</strong></span>
                                <input class="form-control" type="text" name="numero_endereco" value="<?= isset($config_empresa->numero_endereco) ? $config_empresa->numero_endereco : "" ?>" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="nome">Bairro</label><span class="obrigatorio"> <strong> *</strong></span>
                                <input class="form-control" type="text" id="bairro" name="bairro" value="<?= isset($config_empresa->bairro) ? $config_empresa->bairro : "" ?>" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-danger" onclick='location.href = "<?= URL . "home" ?>"'>Voltar <i class="fa fa-arrow-left icone-fa-left"></i></button>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-block btn-primary">Salvar <i class="fa fa-floppy-o icone-fa-left"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<?php if (isset($_GET['atualizado']) && $_GET['atualizado'] == 'true') { ?>
    <script>
        toastSucessMessage('Atualização realizada com sucesso!');
    </script>
<?php } ?>