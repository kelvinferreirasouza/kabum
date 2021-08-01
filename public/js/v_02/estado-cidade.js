$(document).ready(function() {
    let uf_estado = $('#estado option:selected').val();

    if (uf_estado != "" && uf_estado != null) {

        $.ajax(url + "/ajax/getCidadesSelects/" + uf_estado, { async: false }).done(function(result) {

            $('#cidade').empty();

            let obj = jQuery.parseJSON(result);

            let id_cidade = $('#cidade').val();

            for (let item in obj) {
                if (obj[item].id == id_cidade) {
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
});