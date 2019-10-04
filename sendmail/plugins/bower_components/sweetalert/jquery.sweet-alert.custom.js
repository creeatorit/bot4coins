
!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
    //Basic
    $('#sa-basic').click(function(){
        swal("Here's a message!");
    });

    //A title with a text under
    $('#sa-title').click(function(){
        swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.")
    });
	
	//A title with a text under
    $('#sa-atividade-read').click(function(){
        swal("<?php echo $id;?>")
    });

    //Success Message
    $('#sa-success').click(function(){
        swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.", "success")
    });

    //Warning Message
    $('#sa-warning').click(function(){
        swal({   
            title: "ATENÇÃO",   
            text: "Tem certeza que deseja excluir a atividade selecionada?!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, tenho certeza!",   
			cancelButtonText: "Não, não tenho!",
            closeOnConfirm: false 
        }, function(){   
            swal("Excluído!", "Atividade excluída com sucesso!.", "success"); 
        });
    });
	
	//Pop-up Atividades Atrasadas
    $('#sa-atividades-atraso').click(function(){
        swal({   
            title: "ATENÇÃO",   
            text: "Você possui X atividades em atraso",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Visualizar atividades!",   
			cancelButtonText: "Deixar para depois!",
            closeOnConfirm: false 
        }, function(){   
           location.href='http://www.onda.com.br';
        });
    });

    //Parameter
    $('#sa-params').click(function(){
        swal({   
            title: "ATENÇÃO",   
            text: "Tem certeza que deseja excluir a atividade selecionada?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, tenho certeza!",   
            cancelButtonText: "Não, não tenho!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
            if (isConfirm) {     
                swal("Deleted!", "Your imaginary file has been deleted.", "success");   
            } else {     
                swal("Cancelled", "Your imaginary file is safe :)", "error");   
            } 
        });
    });

    //Custom Image
    $('#sa-image').click(function(){
        swal({   
            title: "Govinda!",   
            text: "Recently joined twitter",   
            imageUrl: "../plugins/images/users/govinda.jpg" 
        });
    });

    //Auto Close Timer
    $('#sa-close').click(function(){
         swal({   
            title: "Auto close alert!",   
            text: "I will close in 2 seconds.",   
            timer: 2000,   
            showConfirmButton: false 
        });
    });


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);