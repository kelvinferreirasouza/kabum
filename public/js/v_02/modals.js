// MODAL ATIVAR/DESATIVAR USUÁRIO

$('.btn-desativar-usuario').click(function() {
    $('#desativa-usuario').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "usuarios/desativarusuario/" + id);
});

$('.btn-ativar-usuario').click(function() {
    $('#ativa-usuario').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "usuarios/ativarusuario/" + id);
});

// MODAL ATIVAR/DESATIVAR BENEFÍCIO

$('.btn-desativar-beneficio').click(function() {
    $('#desativa-beneficio').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "beneficios/desativarbeneficio/" + id);
});

$('.btn-ativar-beneficio').click(function() {
    $('#ativa-beneficio').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "beneficios/ativarbeneficio/" + id);
});

// MODAL ATIVAR/DESATIVAR CARTÃO

$('.btn-desativar-cartao').click(function() {
    $('#desativa-cartao').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "cartoes/desativarcartao/" + id);
});

$('.btn-ativar-cartao').click(function() {
    $('#ativa-cartao').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "cartoes/ativarcartao/" + id);
});

// MODAL ATIVAR/DESATIVAR STATUS PAGAMENTO

$('.btn-desativar-status-pagamento').click(function() {
    $('#desativa-status-pagamento').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "statuspagamento/desativarstatuspagamento/" + id);
});

$('.btn-ativar-status-pagamento').click(function() {
    $('#ativa-status-pagamento').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "statuspagamento/ativarstatuspagamento/" + id);
});

// MODAL DESVINCULAR BENEFICIO

$('.btn-desvincular-beneficio').click(function() {
    $('#desvincular-beneficio').modal('show');
    var id = $(this).attr('id');
    $('.form-desvincular').attr('action', url + "cartoes/desvincularbeneficio/" + id_cartao + "/" + id);
});

// MODAL ATIVAR/DESATIVAR CÉLULA DE NEGÓCIO

$('.btn-desativar-celula-negocio').click(function() {
    $('#desativa-celula-negocio').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "celuladenegocio/desativarcelula/" + id);
});

$('.btn-ativar-celula-negocio').click(function() {
    $('#ativa-celula-negocio').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "celuladenegocio/ativarcelula/" + id);
});

// MODAL ATIVAR/DESATIVAR PLATAFORMAS

$('.btn-desativar-plataforma').click(function() {
    $('#desativa-plataforma').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "plataformas/desativarplataforma/" + id);
});

$('.btn-ativar-plataforma').click(function() {
    $('#ativa-plataforma').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "plataformas/ativarplataforma/" + id);
});

// MODAL ATIVAR/DESATIVAR VENDEDOR -> PLATAFORMA

$('.btn-desativar-vendedor-plataforma').click(function() {
    $('#desativa-vendedor-plataforma').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "plataformas/desativarvendedor/" + id_plataforma + "/" + id);
});

$('.btn-ativar-vendedor-plataforma').click(function() {
    $('#ativa-vendedor-plataforma').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "plataformas/ativarvendedor/" + id_plataforma + "/" + id);
});

// MODAL ATIVAR/DESATIVAR VENDEDOR

$('.btn-desativar-vendedor').click(function() {
    $('#desativa-vendedor').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "vendedores/desativar/" + id);
});

$('.btn-ativar-vendedor').click(function() {
    $('#ativa-vendedor').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "vendedores/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR CLIENTE

$('.btn-desativar-cliente').click(function() {
    $('#desativa-cliente').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "clientes/desativarcliente/" + id);
});

$('.btn-ativar-cliente').click(function() {
    $('#ativa-cliente').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "clientes/ativarcliente/" + id);
});

// MODAL ATIVAR/DESATIVAR PRAZO

$('.btn-desativar-prazo').click(function() {
    $('#desativa-prazo').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "prazos/desativarprazo/" + id);
});

$('.btn-ativar-prazo').click(function() {
    $('#ativa-prazo').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "prazos/ativarprazo/" + id);
});

// MODAL SELECIONAR PRODUTOS

$('#selecionar_produtos').click(function() {
    $('#mostra-produtos').modal('show');
});

// MODAL ATIVAR/DESATIVAR STATUS PEDIDO

$('.btn-desativar-status-pedido').click(function() {
    $('#desativa-status-pedido').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "statuspedido/desativarstatuspedido/" + id);
});

$('.btn-ativar-status-pedido').click(function() {
    $('#ativa-status-pedido').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "statuspedido/ativarstatuspedido/" + id);
});

// MODAL ATIVAR/DESATIVAR CATEGORIA

$('.btn-desativar-categoria').click(function() {
    $('#desativa-categoria').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "categorias/desativar/" + id);
});

$('.btn-ativar-categoria').click(function() {
    $('#ativa-categoria').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "categorias/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR USUÁRIO

$('.btn-desativar-cliente').click(function() {
    $('#desativa-cliente').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "clientes/desativar/" + id);
});

$('.btn-ativar-cliente').click(function() {
    $('#ativa-cliente').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "clientes/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR TICKET

$('.btn-desativar-ticket').click(function() {
    $('#desativar-ticket').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "tickets/desativar/" + id);
});

$('.btn-ativar-ticket').click(function() {
    $('#ativar-ticket').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "tickets/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR PROFISSIONAL

$('.btn-desativar-profissional').click(function() {
    $('#desativa-profissional').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "profissional/desativar/" + id);
});

$('.btn-ativar-profissional').click(function() {
    $('#ativa-profissional').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "profissional/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR PERGUNTA

$('.btn-desativar-pergunta').click(function() {
    $('#desativa-pergunta').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "FAQ/desativar/" + id);
});

$('.btn-ativar-pergunta').click(function() {
    $('#ativa-pergunta').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "FAQ/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR FRANQUIA

$('.btn-desativar-franquia').click(function() {
    $('#desativa-franquia').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "franquias/desativar/" + id);
});

$('.btn-ativar-franquia').click(function() {
    $('#ativa-franquia').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "franquias/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR FILIAL

function clickDesativarFilial(id_filial, id_franquia) {
    $('#desativa-filial').modal('show');

    $('.form-desativar').attr('action', url + "filiais/desativar/" + id_filial);
    $('.form-desativar').append(`<input type="hidden" name="id_franquia" value="${id_franquia}">`)
}

function clickAtivarFilial(id_filial, id_franquia) {
    $('#ativa-filial').modal('show');

    $('.form-ativar').attr('action', url + "filiais/ativar/" + id_filial);
    $('.form-ativar').append(`<input type="hidden" name="id_franquia" value="${id_franquia}">`)
}

// MODAL ATIVAR/DESATIVAR BANCO

$('.btn-desativar-banco').click(function() {
    $('#desativa-banco').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "banco/desativar/" + id);
});

$('.btn-ativar-banco').click(function() {
    $('#ativa-banco').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "banco/ativar/" + id);
});

// MODAL VENDEDOR - DESATIVAR

$(document).on('click', '.btn-desativar-vendedor', function() {
    var id_vendedor = $(this).attr('data-id');

    $('#desativa-vendedor').modal('show');

    $('.btn-desativar-vend-modal').attr('data-id', id_vendedor);
});

$(document).on('click', '.btn-desativar-vend-modal', function() {
    var id_vendedor = $(this).attr('data-id');
    $('#desativa-vendedor').modal('hide');
    desativaVendedorFilial(id_vendedor);
});

// MODAL VENDEDOR - ATIVAR

$(document).on('click', '.btn-ativar-vendedor', function() {
    var id_vendedor = $(this).attr('data-id');
    $('#ativa-vendedor').modal('show');
    $('.btn-ativar-vend-modal').attr('data-id', id_vendedor);
});

$(document).on('click', '.btn-ativar-vend-modal', function() {
    var id_vendedor = $(this).attr('data-id');
    $('#ativa-vendedor').modal('hide');
    ativaVendedorFilial(id_vendedor);
});

// MODAL ATIVAR/DESATIVAR STATUS AGENDAMENTO

$('.btn-desativar-status-agendamento').click(function() {
    $('#desativa-status-agendamento').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "StatusAgendamento/desativar/" + id);
});

$('.btn-ativar-status-agendamento').click(function() {
    $('#ativa-status-agendamento').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "StatusAgendamento/ativar/" + id);
});

// MODAL ATIVAR/DESATIVAR STATUS PAGAMENTO

$('.btn-desativar-status-pag').click(function() {
    $('#desativa-status-pag').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "StatusPagamento/desativar/" + id);
});

$('.btn-ativar-status-pag').click(function() {
    $('#ativa-status-pag').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "StatusPagamento/ativar/" + id);
});

// MODAL SUBCATEGORIA - DESATIVAR

$(document).on('click', '.btn-desativar-subcategoria', function() {
    var id_sub_categoria = $(this).attr('data-id');

    $('#desativa-subcategoria').modal('show');

    $('.btn-desativar-subcategoria-modal').attr('data-id', id_sub_categoria);
});

$(document).on('click', '.btn-desativar-subcategoria-modal', function() {
    var id_sub_categoria = $(this).attr('data-id');
    $('#desativa-subcategoria').modal('hide');
    desativaSubCategoria(id_sub_categoria);
});

// MODAL SUBCATEGORIA - ATIVAR

$(document).on('click', '.btn-ativar-subcategoria', function() {
    var id_sub_categoria = $(this).attr('data-id');
    $('#ativa-subcategoria').modal('show');
    $('.btn-ativar-subcategoria-modal').attr('data-id', id_sub_categoria);
});

$(document).on('click', '.btn-ativar-subcategoria-modal', function() {
    var id_sub_categoria = $(this).attr('data-id');
    $('#ativa-subcategoria').modal('hide');
    ativaSubCategoria(id_sub_categoria);
});

// MODAL ATIVAR/DESATIVAR CIDADE

$('.btn-desativar-cidade').click(function() {
    $('#desativa-cidade').modal('show');
    var id = $(this).attr('id');
    $('.form-desativar').attr('action', url + "cidades/desativar/" + id);
});

$('.btn-ativar-cidade').click(function() {
    $('#ativa-cidade').modal('show');
    var id = $(this).attr('id');
    $('.form-ativar').attr('action', url + "cidades/ativar/" + id);
});

// MODAL BAIRROS - DESATIVAR

$(document).on('click', '.btn-desativar-bairro', function() {
    var id_bairro = $(this).attr('data-id');

    $('#desativa-bairro').modal('show');

    $('.btn-desativar-bairro-modal').attr('data-id', id_bairro);
});

$(document).on('click', '.btn-desativar-bairro-modal', function() {
    var id_bairro = $(this).attr('data-id');
    $('#desativa-bairro').modal('hide');
    desativaBairro(id_bairro);
});

// MODAL BAIRROS - ATIVAR

$(document).on('click', '.btn-ativar-bairro', function() {
    var id_bairro = $(this).attr('data-id');
    $('#ativa-bairro').modal('show');
    $('.btn-ativar-bairro-modal').attr('data-id', id_bairro);
});

$(document).on('click', '.btn-ativar-bairro-modal', function() {
    var id_bairro = $(this).attr('data-id');
    $('#ativa-bairro').modal('hide');
    ativaBairro(id_bairro);
});

// MODAL REGIOES ATENDIDAS - DESATIVAR

$(document).on('click', '.btn-desativar-regiao', function() {
    var id_regiao = $(this).attr('data-id');

    $('#desativa-regiao').modal('show');

    $('.btn-desativar-regiao-modal').attr('data-id', id_regiao);
});

$(document).on('click', '.btn-desativar-regiao-modal', function() {
    var id_regiao = $(this).attr('data-id');
    $('#desativa-regiao').modal('hide');
    desativaRegiao(id_regiao);
});

// MODAL BAIRROS - ATIVAR

$(document).on('click', '.btn-ativar-bairro', function() {
    var id_bairro = $(this).attr('data-id');
    $('#ativa-bairro').modal('show');
    $('.btn-ativar-bairro-modal').attr('data-id', id_bairro);
});

$(document).on('click', '.btn-ativar-bairro-modal', function() {
    var id_bairro = $(this).attr('data-id');
    $('#ativa-bairro').modal('hide');
    ativaBairro(id_bairro);
});