/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(
    function ($) {

        $('#placa').mask('aaa-9999');

        $('#tirarfoto').click(
            function () {
                $('.aparece').show();
                webcam.snap();
            }
        );

        $('.aparece').hide();

        $('#placa').keyup(
            function() {
                $(this).val($(this).val().toUpperCase());
            }
        );

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



        $("#nome_fabricante").change(
            function() {

                var fab = $('#nome_fabricante').val();
                if(fab != '') {
                    $.ajax(
                        {
                            type: "POST",
                            url: "../public/ajax/veiculo/consulta.php",
                            data: { id:fab},
                            dataType: "json",
                            success: function(json){

                                var id =json.id_veiculo;
                                var veiculo =json.veiculo;
                                var options = '<option value="0">Selecione.. </option>';
                                $.each(
                                    json, function( id,veiculo){
                                        options += '<option value="' + id + '">' + veiculo + '</option>';
                                    }
                                );

                                $("#veiculo").html(options);
                            }
                        }
                    );
                }

            }
        );

        $("#salvar").click(
            function() {
                if($('#placa').val() == '') {
                    $(document).trigger(
                        "add-alerts", {
                            message: "Campo placa Obrigatório!",
                            priority: "error"
                        }
                    );
                    $("#alerts").hide(5000);
                    //$('#placa').onfocus();
                    return false;
                }
                if($('#nome_fabricante').val() == '') {
                    $(document).trigger(
                        "add-alerts", {
                            message: "Campo fabricante Obrigatório!",
                            priority: "error"
                        }
                    );
                    $("#alerts").hide(5000);
                    return false;
                }
                if($('#veiculo').val() == 0) {
                    $(document).trigger(
                        "add-alerts", {
                            message: "Campo veículo Obrigatório!",
                            priority: "error"
                        }
                    );
                    $("#alerts").hide(5000);
                    //$('#veiculo').onfocus();
                    return false;
                }

                $("#formEntrada").submit();

            }
        );


        $("#nome_fabricante").change(
            function() {

                var fab = $('#nome_fabricante').val();
                if(fab != '') {
                    $.ajax(
                        {
                            type: "POST",
                            url: "../public/ajax/veiculo/consulta.php",
                            data: { id:fab},
                            dataType: "json",
                            success: function(json){

                                var id =json.id_veiculo;
                                var veiculo =json.nome_veiculo;
                                var options = '<option value="">Selecione.. </option>';
                                $.each(
                                    json, function( id,veiculo){
                                        options += '<option value="' + id + '">' + veiculo + '</option>';
                                    }
                                );

                                $("#modelo").html(options);
                            }
                        }
                    );
                }

            }
        );

        $("#tpveiculo").change(
            function() {
                var tpv = $('#tpveiculo').val();
                if(tpv != '') {
                    $.ajax(
                        {
                            type: "POST",
                            url: "../public/ajax/veiculo/consultaFabricante.php",
                            data: { id:tpv},
                            dataType: "json",
                            success: function(json){

                                var id =json.id_fabricante;
                                var fabricante =json.nome_fabricante;
                                var options = '<option value="">Selecione.. </option>';
                                $.each(
                                    json, function( id,fabricante){
                                        options += '<option value="' + id + '">' + fabricante + '</option>';
                                    }
                                );

                                $("#nome_fabricante").html(options);
                            }
                        }
                    );
                }

            }
        );




    }
);