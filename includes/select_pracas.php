<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/titulo_pracas.json', function (data) {

				var items = [];
				var options = '<option value="">SELECIONE A EMISSORA</option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#praca").html(options);				
				
				$("#praca").change(function () {				
				
					var options_localidade = '';
					var str = "";					
					
					$("#praca option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.localidade, function (key_city, val_city) {
								options_localidade += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#localidade").html(options_localidade);
					
				}).change();		
			
			});
		
		});
		

		
</script>