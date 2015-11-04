$(document).ready(function () {

    $('#liberaCampo').click(function () {

        if ($('#liberaCampo').prop("checked")) {
            $("#vaga").removeAttr("readonly");
            $("#alterar").removeClass("disabled");
        }  else{
            $("#vaga").attr("readonly", "readonly");
            $("#alterar").addClass("disabled");
        }

    });
});