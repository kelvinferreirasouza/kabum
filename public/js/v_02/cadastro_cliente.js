const ID_TIPO_PESSOA_FISICA = 1;
const ID_TIPO_PESSOA_JURIDICA = 2;

$('.id_tipo_cliente').on('click', function() {
    const id_tipo = $(this).val();
    verificaTipoCliente(id_tipo);
    
});

$(document).ready(function() {
    const id_tipo = $('.id_tipo_cliente:checked').val();
    verificaTipoCliente(id_tipo);
});

function verificaTipoCliente(id_tipo){
    if(id_tipo == ID_TIPO_PESSOA_JURIDICA){
        $("#nome").prop('required', false);
        $(".dados_nome").hide();
        
        $(".dados_pessoa_juridica").show();
        
        $("#cpf_cnpj").inputmask({
            mask: ['99.999.999/9999-99'],
            keepStatic: true
        });

        $("#nome_empresa").prop('required', true);
        $("#nome_responsavel_empresa").prop('required', true);
        $("#cpf_responsavel_empresa").prop('required', true);

    }else{
        $("#nome_empresa").prop('required', false);
        $("#nome_responsavel_empresa").prop('required', false);
        $("#cpf_responsavel_empresa").prop('required', false);
        
        $("#cpf_cnpj").inputmask({
            mask: ['999.999.999-99'],
            keepStatic: true
        });

        $(".dados_pessoa_juridica").hide();

        $(".dados_nome").show();
        $("#nome").prop('required', true);
    }
}

$('#cpf_cnpj').on('blur', async function() {
    let cpf_cnpj = $(this).val();
    cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g, '');
    let cpf_cnpj_salvo = $("#cpf_cnpj_saved").val();
    let existe = false;
    
    if(cpf_cnpj_salvo != cpf_cnpj){
        $.ajax({
            url: url + "/ajax/existePessoaByCpfCnpj/",
            dataType: 'json',
            method: 'POST',
            data: { "cpf_cnpj" : cpf_cnpj },
            async: false,

            success: function(response) {
                
                if(response){
                    toastError("Cliente já cadastrado!");
                    $(this).parent().addClass("has-error");
                    existe = true;
                    return;
                }
            } 
        });
    }

    const id_tipo_cliente = $('.id_tipo_cliente:checked').val();
    let validacao = false;
    let tipoDocumento = "";

    if(id_tipo_cliente == ID_TIPO_PESSOA_JURIDICA){
        validacao = validarCNPJ(cpf_cnpj);
        tipoDocumento = "CNPJ";
        
    }else{
        validacao = validarCpf(cpf_cnpj);
        tipoDocumento = "CPF";
    }
    if(!existe){
        if(validacao){
            $(this).parent().removeClass("has-error");
            const response = await buscaDadosCnpj(cpf_cnpj);

            $('#nome_empresa').val(response.nome);
            $('#endereco').val(response.logradouro);
            $('#cep').val(response.cep).trigger("blur");
            $('#numero_endereco').val(response.numero);
            $('#email').val(response.email);
            $('#telefone').val(response.telefone);
            return;

        }else{

            $(this).parent().addClass("has-error");
            const msgErro = `Número de ${tipoDocumento} inválido!`;
            toastError(msgErro);
            return;
        }
    }
});

$('#cpf_responsavel_empresa').on('blur', async function() {
    let cpf_cnpj = $(this).val();
    cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g, '');
    let validacao = false;

    validacao = validarCpf(cpf_cnpj);
    
    if(validacao){
        $(this).parent().removeClass("has-error");

    }else{
        $(this).parent().addClass("has-error");
        const msgErro = `Número de CPF inválido!`;
        toastError(msgErro);
    }
});
