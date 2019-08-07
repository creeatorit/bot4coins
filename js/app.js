$(document).ready(function() {

    // Abrir modal para enviar boleto
    $(document).on('click',' button[data-modal="#modalBoleto"]', function() {
        var data = $(this).parent().parent();
        var id = data.find('td[data-register-id]').text();
        var cliente = data.find('td[data-register-cliente]').text();

        html = '<big>Código do depósito:</big> ' + id + ' <br /> <b>Nome do Cliente:</b> ' + cliente + '<br />';
        $('div[data=dadosCliente]').html(html);

        $('input[name=id]').val(id);

         $('#modalBoleto').modal('show');
    });
    
    // Upload da foto do usuario com preview
    $(document).on('change', '.user-photo-edit', function() {
        const file = $(this)[0].files[0];
        const fileReader = new FileReader();
        var imagem = $(this)[0].files;
        fileReader.onloadend = function () {
            $('.user-photo-preview').attr('src', fileReader.result);
            
            var data = new FormData();    
            data.append('file', file);     
            $.ajax({
                type: 'POST',
                url: 'includes/user-photo-update.php',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }

            });
            
        }
        fileReader.readAsDataURL(file);       
    });
});