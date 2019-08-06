<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/titulo_atividade.json', function (data) {

				var items = [];
				var options = '<option value="">Selecione o título da atividade</option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#atividade1").html(options);				
				
				$("#atividade1").change(function () {				
				
					var options_atividade = '';
					var str = "";					
					
					$("#atividade1 option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.atividade, function (key_city, val_city) {
								options_atividade += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#atividade").html(options_atividade);
					
				}).change();		
			
			});
		
		});
		
</script>