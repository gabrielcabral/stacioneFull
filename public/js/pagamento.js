/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(
    function ($) {



        var mask = {
            money: function() {
                var el = this
                ,exec = function(v) {
                    v = v.replace(/\D/g,"");
                    v = new String(Number(v));
                    var len = v.length;
                    if (1== len) {
                        v = v.replace(/(\d)/,"0,0$1"); }
                    else if (2 == len) {
                        v = v.replace(/(\d)/,"0,$1"); }
                    else if (len > 2) {
                        v = v.replace(/(\d{2})$/,',$1');
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

        function formatReal( int )
        {
            var tmp = int+'';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

            return tmp;
        }




       $('#tpPagamento').change(function(){

           var tipo = $('#tpPagamento').val();
           var total = formatReal($('#total').val()+"00");

           if(tipo != 0){
               $('#recebido').val(total);
               $('#troco').val('0,00');

           }

       });
        $('#recebido').bind('keypress',mask.money);
        $('#recebido').keydown  (function(){


            var total =   formatReal($('#total').val()+"00").replace(',','');
            var recebido = $('#recebido').val().replace(',','');


            var darTroco = recebido - total;


            $('#troco').val(  formatReal(darTroco));
        });

        $('#receber').click(function(){
            $('#formEfetuarPagamento').submit();
            if ($('#tpPagamento').val() == 0){
                $(document).trigger("add-alerts", [
                    {
                        'message': "Selecione um tipo de pagamento!",
                        'priority': 'danger'
                    }
                ]);
                return false;
            }




            var total =   formatReal($('#total').val()+"00").replace(',','');
            var recebido = $('#recebido').val().replace(',','');

            if(recebido >= total){
              //  $('#formEfetuarPagamento').submit();
            }else {
                $(document).trigger("add-alerts", [
                    {
                        'message': "O valor recebido é menor do que o total a ser pago!",
                        'priority': 'danger'
                    }
                ]);
                //return false;
            }

            $('#formEfetuarPagamento').submit();
        });
    }
);