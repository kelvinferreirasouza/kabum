$(document).on('change', '#cpf', function() {
    let cpf = $(this).val();

    let validacao = validarCpf(cpf);

    if (validacao) {
        verificaCpfUnico(cpf);
    } else {
        toastError('CPF inválido');
        $('.btn-submit').attr('disabled', true);
    }
});

function verificaCpfUnico(cpf) {
    if (cpf != "" && cpf != null) {
        $.ajax({
            url: url + "ajax/getClienteByCpf/",
            dataType: 'json',
            method: 'POST',
            data: {
                'cpf': cpf,
            },
            async: false,
            success: function(result) {
                if (result == true) {
                    toastError('Este CPF já possui cadastro.');
                    $('.btn-submit').attr('disabled', true);
                } else {
                    $('.btn-submit').attr('disabled', false);
                }
            }
        });
    } else {
        toastError('Deve ser informado o CPF.');
    }
}

$(document).on('click', '.btn-submit', function() {

    let validacao = validaCampos('.box-cadastro-cliente');

    if (validacao == true) {
        $('.form-cad-usuario').submit();
    } else {
        toastError('Preencha todos os campos obrigatórios.');
    }
});

$(document).on('click', '.btn-submit-end', function() {

    let validacao = validaCampos('.box-cadastro-endereco');

    if (validacao == true) {

        var formElement = document.getElementById("form-cad-end");
        var formData = new FormData(formElement);

        $.ajax({
            url: url + "ajax/adicionarEnderecoCliente/",
            dataType: 'json',
            method: 'POST',
            data: formData,
            async: false,
            processData: false,
            contentType: false,
            success: function(result) {
                if (!result.error) {
                    appendNovoEndereco(result.endereco_cadastrado);
                    toastSucessMessage('Endereço cadastrado com sucesso.');
                } else {
                    toastError(result.message);
                }
            }
        });
    } else {
        toastError('Preencha todos os campos obrigatórios.');
    }
});

function appendNovoEndereco(endereco) {
    let html = '';

    html += `<tr class="endereco_${endereco.id}">`;
    html += `    <td>${endereco.endereco}, ${endereco.numero} ${endereco.complemento != "" ? " - " + endereco.complemento : ""}</td>`;
    html += `    <td>${formatExibicaoMultiStrings(endereco.nome_cidade)} / ${endereco.uf_estado}</td>`;
    html += `    <td>${endereco.cep}</td>`;
    html += `    <td>`;
    html += `        <div class="text-center">`;
    html += `            <a class="btn-circle btn-primary btn-editar-endereco" data-id="${endereco.id}"><i class="fa fa-pencil"></i></a>`;
    html += `            <a class="btn-circle btn-danger btn-excluir-endereco" data-id="${endereco.id}"><i class="fa fa-times"></i></a>`;
    html += `        </div>`;
    html += `    </td>`;
    html += `</tr>`;

    $('.tr-nenhum-end').remove();

    $('.enderecos').append(html);

    limpaCamposEndereco();

    $('.btn-box-tool').click();
}

$(document).on('click', '.btn-excluir-endereco', function() {
    let id_endereco = $(this).attr('data-id');

    if (id_endereco != '') {
        $.ajax({
            url: url + "ajax/excluirEnderecoCliente/",
            dataType: 'json',
            method: 'POST',
            data: {
                'id': id_endereco,
            },
            async: false,
            success: function(result) {
                if (!result.error) {
                    toastSucessMessage(result.message);

                    $(".endereco_" + id_endereco).remove();

                    let qtd_resultados = $('#tabela-enderecos tr').length;

                    if (qtd_resultados == "1") {

                        html = `<tr class="tr-nenhum-end">
                                    <td class='text-center' colspan='7'>Nenhum endereço cadastrado.</td>
                                </tr>`;

                        $(".enderecos").append(html);
                    }
                } else {
                    toastError(result.message);
                }
            }
        });
    }
});

$(document).on('click', '.btn-editar-endereco', function() {
    let id_endereco = $(this).attr('data-id');

    if (id_endereco != '') {
        $.ajax({
            url: url + "ajax/getEnderecoClienteById/",
            dataType: 'json',
            method: 'POST',
            data: {
                'id_endereco': id_endereco,
            },
            async: false,
            success: function(result) {
                if (!result.error) {
                    preencheCamposEndereco(result.endereco_cadastrado, id_endereco)
                } else {
                    toastError(result.message);
                }
            }
        });
    }
});

function preencheCamposEndereco(endereco, id_endereco) {
    if (!$(".box-cadastro-endereco").is(":visible")) {
        $('.btn-box-tool').click();
    }

    $('#cep').val(endereco.cep);
    $('#cep').trigger("blur");

    setTimeout(function() {
        $('#endereco').val(endereco.endereco);
        $('#numero_endereco').val(endereco.numero);
        $('#bairro').val(endereco.bairro);
        $('#complemento').val(endereco.complemento);
    }, 600);

    $('.btn-submit-end').html('Atualizar <i class="fa fa-check icon-fa-left"></i>');
    $('.btn-submit-end').removeClass('btn-submit-end').addClass('btn-update-end');
    $('.btn-update-end').attr('data-id', id_endereco);
}

$(document).on('click', '.btn-update-end', function() {
    let formElement = document.getElementById("form-cad-end");
    let formData = new FormData(formElement);

    let id_endereco = $(this).attr('data-id')

    formData.append('id_endereco', id_endereco);

    if (id_endereco != '') {
        $.ajax({
            url: url + "ajax/updateEnderecoClienteById/",
            dataType: 'json',
            method: 'POST',
            data: formData,
            async: false,
            processData: false,
            contentType: false,
            success: function(result) {
                if (!result.error) {
                    limpaCamposEndereco();

                    $('.btn-update-end').html('Cadastrar <i class="fa fa-check icon-fa-left"></i>');
                    $('.btn-update-end').addClass('btn-submit-end').removeClass('btn-submit-end');

                    $('.btn-box-tool').click();

                    toastSucessMessage('Endereço atualizado.');

                    $(".endereco_" + id_endereco).remove();

                    appendNovoEndereco(result.endereco_cadastrado);
                } else {
                    toastError(result.message);
                }
            }
        });
    }
});

function limpaCamposEndereco() {
    inputs = $('.box-cadastro-endereco').find($('input'));

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].name != "id_cliente") {
            $(inputs[i]).val('');
        }
    }
}