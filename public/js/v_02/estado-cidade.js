$(document).ready(function() {
    let uf_estado = $('#estado option:selected').val();

    if (uf_estado != "" && uf_estado != null ) {
        $.ajax(url + "/ajax/getCidadesSelects/" + uf_estado, { async: false }).done(function(result) {
            $('#cidade').empty();
            let obj = jQuery.parseJSON(result);

            let id_cidade = $('#id_cidade_saved').val();
            let id_bairro = $('#id_bairro_saved').val();

            for (let item in obj) {
                if (obj[item].id == id_cidade) {
                    $.ajax({
                        url: url + "ajax/getBairrosByIdCidade/",
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            'id_cidade': id_cidade,
                        },
                        async: false,
                        success: function(result) {
                            $('#bairro').empty();
                            let obj = result;

                            for (let item in obj) {
                                if (obj[item].id == id_bairro) {
                                    $('#bairro').append($('<option>', {
                                        value: obj[item].id,
                                        text: obj[item].nome,
                                        selected: 'selected'
                                    }));
                                } else {
                                    $('#bairro').append($('<option>', {
                                        value: obj[item].id,
                                        text: obj[item].nome
                                    }));
                                }
                            }
                        }
                    });
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
    }

    $(document).on('change', '#estado', function() {
        let uf_estado = $('#estado option:selected').val();
        if (uf_estado != "" && uf_estado != null) {
            $.ajax(url + "/ajax/getCidadesSelects/" + uf_estado, { async: false }).done(function(result) {
                $('#cidade').empty();
                let obj = jQuery.parseJSON(result);
                for (let item in obj) {
                    $('#cidade').append($('<option>', {
                        value: obj[item].id,
                        text: obj[item].nome
                    }));
                }
            });
        } else {
            $('#cidade').empty();
        }
    });

    $(document).on('change', '#cidade', function() {
        let id_cidade = $('#cidade option:selected').val();
        if (id_cidade != "" && id_cidade != null) {
            $.ajax({
                url: url + "ajax/getBairrosByIdCidade/",
                dataType: 'json',
                method: 'POST',
                data: {
                    'id_cidade': id_cidade,
                },
                async: false,
                success: function(result) {
                    $('#bairro').empty();
                    let obj = result;

                    for (let item in obj) {
                        $('#bairro').append($('<option>', {
                            value: obj[item].id,
                            text: obj[item].nome
                        }));
                    }
                }
            });
        } else {
            $('#bairro').empty();
        }
    });

    $(document).on('change', '#estado2', function() {
        let uf_estado = $('#estado2 option:selected').val();
        if (uf_estado != "" && uf_estado != null) {
            $.ajax(url + "/ajax/getCidadesSelects/" + uf_estado, { async: true }).done(function(result) {
                $('#cidade2').empty();
                let obj = jQuery.parseJSON(result);
                for (let item in obj) {
                    $('#cidade2').append($('<option>', {
                        value: obj[item].id,
                        text: obj[item].nome
                    }));
                }
            });
        } else {
            $('#cidade').empty();
        }
    });
});