		<footer class="main-footer">
			<strong>Copyright &copy; <?= date("Y") ?> <a href="#"><?= $this->config_sistema->rodape; ?></a>.</strong> Todos os direitos reservados.
		</footer>

		<script>
			var url = "<?= URL; ?>";
			var id_menu = "<?= (isset($menu) ? $menu->id_menu : '') ?>";
		</script>

		<?= $this->renderScript() ?>

		<script>
			$('select').select2();
			$('[data-mask]').inputmask();
			$('[data-mask-money]').maskMoney({
				decimal: ',',
				thousands: '.',
				prefix: 'R$ ',
				affixesStay: false
			});

			$('.data').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
				language: "pt-BR"
			});

			$(".mes").datepicker({
				autoclose: true,
				format: "mm/yyyy",
				viewMode: "months",
				minViewMode: "months",
				language: "pt-BR"
			});

			$("[cnpj_mask]").inputmask({
				mask: ['99.999.999/9999-99'],
				keepStatic: true
			});

			$("[cpf_mask]").inputmask({
				mask: ['999.999.999-99'],
				keepStatic: true
			});

			$('[percent-mask]').maskMoney({
				decimal: '.',
				thousands: "",
				affixesStay: false
			});

			$('[data-mask-money]').maskMoney({
				decimal: ',',
				thousands: '.',
				affixesStay: false
			});

			$("[cpfcnpj_mask]").inputmask({
				mask: ['999.999.999-99', '99.999.999/9999-99'],
				keepStatic: true
			});

			$("[celular_mask]").inputmask("(99) 9 9999-9999");
			$("[fone_mask]").inputmask("(99) 9999-9999");
			$("[cep_mask]").inputmask("99999-999");
		</script>
	</body>
</html>