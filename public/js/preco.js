$(document).ready(
    function () {



        $('#liberaCampo').click(
            function () {

                if ($('#liberaCampo').prop("checked")) {
                    $("#preco").removeAttr("readonly");
                    $("#alterar").removeClass("disabled");
                }  else{
                    $("#vaga").attr("readonly", "readonly");
                    $("#alterar").addClass("disabled");
                }

            }
        );

        var mask = {
            money: function() {
                var el = this
                ,exec = function(v) {
                    v = v.replace(/\D/g,"");
                    v = new String(Number(v));
                    var len = v.length;
                    if (1== len) {
                        v = v.replace(/(\d)/,"0.0$1"); }
                    else if (2 == len) {
                        v = v.replace(/(\d)/,"0.$1"); }
                    else if (len > 2) {
                        v = v.replace(/(\d{2})$/,'.$1');
                    }
                    return v;
                };

                setTimeout(
                    function(){
                        el.value = exec(el.value);
                    },1
                );
            }

        }


        $('#preco').bind('keypress',mask.money);
        $('#recebido').bind('keypress',mask.money)


        $('#tpPagamento').click(
            function () {
                //$( "#tpPagamento" ).change(function() {
                alert($('#tpPagamento').val());
                var tpPagamento= $('#tpPagamento').val();
                /* var valor = $('#total').val();
                if(tpPagamento == 1){
                }else if(tpPagamento == 2 ||tpPagamento == 3 ){
                $("#recebido").val(valor);
                }*/


            }
        );

    }
);