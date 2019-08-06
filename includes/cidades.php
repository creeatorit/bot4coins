<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/populacao.json', function (data) {

				var items = [];
				var options = '<option value=""> </option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#municipio").html(options);				
				
				$("#municipio").change(function () {				
				
					var options_populacao = '';
					var str = "";					
					
					$("#municipio option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.populacao, function (key_city, val_city) {
								options_populacao += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#populacao").html(options_populacao);
					
				}).change();		
			
			});
		
		});
		

		
</script>