<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/issuer-sectors-inventory.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#Issuer").html(options);				
				
				$("#Issuer").change(function () {				
				
					var options_Sector = '';
					var str = "";					
					
					$("#Issuer option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.Sector, function (key_city, val_city) {
								options_Sector += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#Sector").html(options_Sector);
					
				}).change();		
			
			});
		
		});
		
</script>