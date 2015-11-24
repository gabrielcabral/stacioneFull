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


        $('#recebido').bind('keypress',mask.money)

       $('#tpPagamento').change(function(){

           var tipo = $('#tpPagamento').val();
           var total = formatReal($('#total').val()+"00");

           if(tipo != 0){
               $('#recebido').val(total);
           }

       });



    }
);