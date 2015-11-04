$(document).ready(function() {

    $('[data-toggle="confirmation"]').confirmation({

        title:"Deseja excluir?",
        btnOkLabel:"<i class='glyphicon glyphicon-ok-circle'></i> Sim",
        btnCancelLabel:"<i class='glyphicon glyphicon-remove-circle'></i> Não",

        onConfirm: function() {
        },
        onCancel: function() {  }
    });




 $( "#nome_fabricante" ).change(function() {

        var fab = $('#nome_fabricante').val();
        if(fab != ''){
            $.ajax({
                type: "POST",
                url: "../public/ajax/veiculo/consulta.php",
                data: { id:fab},
                dataType: "json",
                success: function(json){

                    var id =json.id_veiculo;
                    var veiculo =json.veiculo;
                    var options = '<option value="">Selecione.. </option>';
                    $.each(json, function( id,veiculo){
                        options += '<option value="' + id + '">' + veiculo + '</option>';
                    });

                    $("#veiculo").html(options);
                }
            });
        }

    });
});