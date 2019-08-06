<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/issuer-transf-sectors.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#transf_praca").html(options);				
				
				$("#transf_praca").change(function () {				
				
					var options_transf_setor = '';
					var str = "";					
					
					$("#transf_praca option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.transf_setor, function (key_city, val_city) {
								options_transf_setor += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#transf_setor").html(options_transf_setor);
					
				}).change();		
			
			});
		
		});
		
</script>