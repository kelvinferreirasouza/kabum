$(function () {
	if (dados_incorretos == 'true') {
		$('.box-senha').removeClass('has-error');
		$('.box-email').removeClass('has-error');
		$('.help-dados').remove();

		$('.box-senha').addClass('has-error');
		$('.box-email').addClass('has-error');
		$('.box-senha').append('<span class="help-block help-dados">Os dados informados estão incorretos</span>');

		$('#email').on('click', function () {
			$('.box-senha').removeClass('has-error');
			$('.box-email').removeClass('has-error');
			$('.help-dados').remove();
		});

		$('#senha').on('click', function () {
			$('.box-senha').removeClass('has-error');
			$('.box-email').removeClass('has-error');
			$('.help-dados').remove();
		});
	};
});

$(function () {
	if (email_incorreto == 'true') {
		$('.box-email').removeClass('has-error');
		$('.help-dados').remove();

		$('.box-email').addClass('has-error');
		$('.box-email').append('<span class="help-block help-dados">Email Invalido</span>');

		$('#email').on('click', function () {
			$('.box-email').removeClass('has-error');
			$('.help-dados').remove();
		});
	};
});

$(function () {
	if (codigo_incorreto == 'true') {
		$('.box-cod_recuperacao').removeClass('has-error');
		$('.help-dados').remove();

		$('.box-cod_recuperacao').addClass('has-error');
		$('.box-cod_recuperacao').append('<span class="help-block help-dados">Código Invalido</span>');

		$('#cod_recuperacao').on('click', function () {
			$('.box-cod_recuperacao').removeClass('has-error');
			$('.help-dados').remove();
		});
	};
});

$(function () {
	if (insert == 'true') {
		$('.box-msg').append('<div class="alert alert-success">Senha redefinida com sucesso</div>');

		$('#email').on('click', function () {
			$('.alert-success').remove();
		});
		$('#senha').on('click', function () {
			$('.alert-success').remove();
		});
	};
});