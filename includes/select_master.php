<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/master_nivel1.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#nivel1").html(options);				
				
				$("#nivel1").change(function () {				
				
					var options_nivel2 = '';
					var str = "";					
					
					$("#nivel1 option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.nivel2, function (key_city, val_city) {
								options_nivel2 += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#nivel2").html(options_nivel2);
					
				}).change();		
			
			});
		
		});
		
		
		$(document).ready(function () {
		
			$.getJSON('js/master_nivel2.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#nivel2").html(options);				
				
				$("#nivel2").change(function () {				
				
					var options_nivel3 = '';
					var str = "";					
					
					$("#nivel2 option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.nivel3, function (key_city, val_city) {
								options_nivel3 += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#nivel3").html(options_nivel3);
					
				}).change();		
			
			});
		
		});
		
</script>