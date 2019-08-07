$(document).ready(function() {
    
    $(document).on('change', '.user-photo-edit', function() {
        const file = $(this)[0].files[0];
        const fileReader = new FileReader();
        var imagem = $(this)[0].files;
        fileReader.onloadend = function () {
            $('.user-photo-preview').attr('src', fileReader.result);
            
            var data = new FormData();    
            data.append('file', file);        
            console.log(data);
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