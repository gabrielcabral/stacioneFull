/**
 * Created by GABRIEL on 21/10/2015.
 */
$(document).ready(
    function() {



        $('#entrar').click(
            function () {
               var login = $('#login').val();
               var senha = $('#senha').val();






                if(login ==''|| senha == '' ){
                    $(document).trigger("add-alerts", [
                    {
                        'message': "Campos obrigatórios não informados!",
                        'priority': 'danger'
                    }
                ]);
                    return false;
            }

                $.ajax(
                    {
                        type: "POST",
                        url: "../public/ajax/login/consulta.php",
                        data: { login:login,senha:senha},
                        dataType: "json",
                        success: function(json){

                            console.log(json);
                            if (json == 0){
                                $(document).trigger("add-alerts", [
                                    {
                                        'message': "Dados informados não encontrados! ",
                                        'priority': 'danger'
                                    }
                                ]);
                                return false;
                            }

                            $('#formLogin').submit();

                        }
                    }
                );

            });


    }




);