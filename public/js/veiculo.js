/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(
    function ($) {


        $('[data-toggle="confirmation"]').confirmation(
            {

                title:"Deseja excluir?",
                btnOkLabel:"<i class='glyphicon glyphicon-ok-circle'></i> Sim",
                btnCancelLabel:"<i class='glyphicon glyphicon-remove-circle'></i> Não",
                onConfirm: function() {
                },
                onCancel: function() {  }
            }
        );

        $("#consultar").click(
            function() {

                $('#formVeiculos').submit();
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