$(document).on('blur', '#cep', async function() {
    const cep = $(this).val();

    swal({
        title: 'Pesquisando',
        button: {
            visible: false,
        },
        onOpen: () => {
            swal.showLoading();
        },
    });

    try {

        const dadosCep = await buscaDadosCep(cep);
        swal.close();

        $("#estado").val(dadosCep.uf).change();

        const cidade = $("#cidade option").filter(function() {
            return $(this).text().toUpperCase() === dadosCep.localidade.toUpperCase();
        }).first().attr("value");

        const bairro = dadosCep.bairro.toUpperCase();

        $.ajax(url + "/ajax/getCidadesSelects/" + dadosCep.uf, { async: false }).done(function(result) {
            $('#cidade').empty();
            let obj = jQuery.parseJSON(result);

            for (let item in obj) {
                if (obj[item].id == cidade) {
                    $('#cidade').append($('<option>', {
                        value: obj[item].id,
                        text: obj[item].nome,
                        selected: 'selected'
                    }));
                } else {
                    $('#cidade').append($('<option>', {
                        value: obj[item].id,
                        text: obj[item].nome
                    }));
                }
            }
        });
        if (dadosCep.logradouro != '') {
            $('#endereco').val(dadosCep.logradouro);
        }
        return;

    } catch (e) {
        swal.close();
        swal('Ops..', 'CEP não encontrado!', 'error');
        return;
    }
});

function buscaDadosCep(cep) {
    return new Promise((resolve, reject) => {
        cep = cep.replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                $.ajax({
                    url: "https://viacep.com.br/ws/" + cep + "/json",
                    type: 'GET',
                    dataType: 'json',
                    success: function(dadosCep) {
                        if (!("erro" in dadosCep)) {
                            resolve(dadosCep)
                        } else {
                            reject(new Error('Erro na requisição.'));
                        }
                    }
                });
            } else {
                reject(new Error('CEP inválido.'));
            }
        }
    });
}

function buscaDadosCidadeEstado(cod_ibge) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url + "ajax/getDadosCidadeByCodigoIbge/",
            dataType: 'json',
            method: 'POST',
            data: {
                'cod_ibge': cod_ibge
            },
            async: false,
            success: function(obj) {
                if (!obj.error) {
                    resolve(obj);
                } else {
                    reject(obj);
                }
            }
        });
    });
}