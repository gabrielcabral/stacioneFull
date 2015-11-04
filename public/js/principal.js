/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(function ($) {

    $('#placa').mask('aaa-9999');
    $( ".input-daterange" ).datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "pt-BR",
        keyboardNavigation: false,
        todayHighlight: true,
        beforeShowMonth: function (date){
            switch (date.getMonth()){
                case 8:
                    return false;
            }
        }
    });

    $('[data-toggle="confirmation"]').confirmation({

        title:"Deseja excluir?",
        btnOkLabel:"<i class='glyphicon glyphicon-ok-circle'></i> Sim",
        btnCancelLabel:"<i class='glyphicon glyphicon-remove-circle'></i> Não",

        onConfirm: function() {
        },
        onCancel: function() {  }
    });

    $('#btnentrada').click(function () {
        window.location.href = 'modulo.php?modulo=entrada&menu=inserir';
    });


    //Configurando o arquivo que vai receber a imagem
    webcam.set_api_url('../upload.php');

    //Setando a qualidade da imagem (1 - 100)
    webcam.set_quality(90);

    //Habilitando o som de click
    webcam.set_shutter_sound(true);

    //Definindo a função que será chamada após o termino do processo
    webcam.set_hook('onComplete', 'my_completion_handler');

    //Função para tirar snapshot
    function take_snapshot() {
        document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
        webcam.snap();
    }

    //Função callback que será chamada após o final do processo
    function my_completion_handler(msg) {
        if (msg.match(/(http\:\/\/\S+)/)) {
            var htmlResult = '<h1>Upload Successful!</h1>';
            htmlResult += '<img src="'+msg+'" />';
            document.getElementById('upload_results').innerHTML = htmlResult;
            webcam.reset();
        }
        else {
            alert("PHP Erro: " + msg);
        }
    }

     function verificar_GetUserMedia() {
     return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
     navigator.mozGetUserMedia);
     }

     if (verificar_GetUserMedia()) {
     } else {
     alert('O seu navegador não suporta o método getUserMedia');
     }
     var em_caso_de_erro = function(erro) {
     console.log('Não funciona!', erro);
     };
     window.navigator.webkitGetUserMedia({video: true, audio: false}, function(midia_local) {
     var video = document.querySelector('video');
     video.src = window.webkitURL.createObjectURL(midia_local);
     video.width = 600;
     video.height = 400;
     }, em_caso_de_erro);

});