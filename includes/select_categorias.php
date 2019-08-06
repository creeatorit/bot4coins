<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('js/titulo_categorias.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#categoria").html(options);				
				
				$("#categoria").change(function () {				
				
					var options_subcategoria = '';
					var str = "";					
					
					$("#categoria option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.subcategoria, function (key_city, val_city) {
								options_subcategoria += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#subcategoria").html(options_subcategoria);
					
				}).change();		
			
			});
		
		});
		
		
		$(document).ready(function () {
		
			$.getJSON('js/titulo_subcategorias.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#subcategoria").html(options);				
				
				$("#subcategoria").change(function () {				
				
					var options_tipoatividade = '';
					var str = "";					
					
					$("#subcategoria option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.tipoatividade, function (key_city, val_city) {
								options_tipoatividade += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#tipoatividade").html(options_tipoatividade);
					
				}).change();		
			
			});
		
		});
		
		
		$(document).ready(function () {
		
			$.getJSON('js/titulo_atividade.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#tipoatividade").html(options);				
				
				$("#tipoatividade").change(function () {				
				
					var options_atividade = '';
					var str = "";					
					
					$("#tipoatividade option:selected").each(function () {
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