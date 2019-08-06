<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/issuer-sectors.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#emissora").html(options);				
				
				$("#emissora").change(function () {				
				
					var options_setor = '';
					var str = "";					
					
					$("#emissora option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.setor, function (key_city, val_city) {
								options_setor += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#setor").html(options_setor);
					
				}).change();		
			
			});
		
		});
		
</script>