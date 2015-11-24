/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(
    function ($) {

        $('#cpfValidado').hide();
        $('[data-toggle="confirmation"]').confirmation(
            {

                title:"Deseja excluir?",
                btnOkLabel:"<i class='glyphicon glyphicon-ok-circle'></i> Sim",
                btnCancelLabel:"<i class='glyphicon glyphicon-remove-circle'></i> Não",
                delay: { show: 500, hide: 100 },
                onConfirm: function() {
                },
                onCancel: function() {  }
            }
        );


        $("#success-alert").fadeTo(2000, 500).slideUp(
            500, function(){
                $("#success-alert").alert('close');
            }
        );
        $("#btnNovoFuncionario").click(
            function () {
                window.location.href = "modulo.php?modulo=funcionario&menu=inserir";
            }
        );
        $(".btnAletrar").click(
            function () {
                window.location.href = "modulo.php?modulo=funcionario&menu=alterar&id="+this.id;
            }
        );

        $("#alterar").click( function () {

            $('#formFuncAlt').submit();
        });
        $("#alterarPasss").click(
            function () {
                if($("#senha").val()!= '') {
                    if($("#senha").val() === $("#cosenha").val()) {
                        $("#formAlterarSenha").submit();
                    }else{
                        $(document).trigger(
                            "add-alerts", [
                            {
                                'message': "A senha estão diferentes",
                                'priority': 'warning'
                            }
                            ]
                        );

                        return false;
                    }
                }else{
                    $(document).trigger(
                        "add-alerts", [
                        {
                            'message': "A senha está em branco!",
                            'priority': 'warning'
                        }
                        ]
                    );

                    return false;
                }

            }
        );


    $('#salvar').click(
        function () {
           var cpf = $("#cpf_funcionario").val();

            var valida = validarCPF(cpf);

            if(valida==false) {
                $("add-alerts").hide();
                $(document).trigger(
                    "add-alerts", {
                        message: "CPF Inválido!!",
                        priority: "warning"
                    }
                );
                return false;
            }
            if($('#nm_funcionario').val() !=""){
                if($('#nm_funcionario').val().length <= 3 ){
                    $(document).trigger(
                        "add-alerts", [
                            {
                                'message': "O Nome tem que conter no minímo 3 caracteres",
                                'priority': 'warning'
                            }
                        ]
                    );
                    return false;
                }
                if($('#nm_funcionario').val().length > 200 ){
                    $(document).trigger(
                        "add-alerts", [
                            {
                                'message': "O Nome tem que conter no máximo 200 caracteres",
                                'priority': 'warning'
                            }
                        ]
                    );
                    return false;
                }
            }
            if($("#dtNascimento").val()== '') {
                $(document).trigger(
                    "add-alerts", [
                        {
                            'message': "A Data de Nascimento é Campo Obrigatório",
                            'priority': 'warning'
                        }
                    ]
                );
                return false;
            }
            if($("#login").val()== '') {
                $(document).trigger(
                    "add-alerts", [
                        {
                            'message': "A login é Campo Obrigatório",
                            'priority': 'warning'
                        }
                    ]
                );
                return false;
            }
            if($("#nm_funcionario").val()== '') {
                $(document).trigger(
                    "add-alerts", [
                        {
                            'message': "O nome é Campo Obrigatório",
                            'priority': 'warning'
                        }
                    ]
                );
                return false;
            }
            if($("#perfil").val()== '') {
                $(document).trigger(
                    "add-alerts", [
                        {
                            'message': "O perfil é Campo Obrigatório",
                            'priority': 'warning'
                        }
                    ]
                );
                return false;
            }

            if($("#password").val()!= '') {
                    if($("#password").val() === $("#confirmePassword").val()) {
                        $('#formFunc').submit();
                    }else{
                        $(document).trigger(
                            "add-alerts", [
                                {
                                    'message': "A senha estão diferentes",
                                    'priority': 'warning'
                                }
                            ]
                        );
                        return false;
                    }
                }else{
                    $(document).trigger(
                        "add-alerts", [
                            {
                                'message': "A senha está em branco!",
                                'priority': 'warning'
                            }
                        ]
                    );
                    return false;
                }









        });



        $(".data").mask("99/99/9999");
        $(".telefone").mask("(99)9999-9999");
        $(".mascaraCpf").mask("999.999.999-99");
        $(".cep").mask("99999-999");
        $(".cnpj").mask("99.999.999/9999-99");
        $(".placa").mask("aaa - 9999");





        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g,'');
            if(cpf == '') { return false; }
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 
                || cpf == "00000000000" 
                || cpf == "11111111111" 
                || cpf == "22222222222" 
                || cpf == "33333333333" 
                || cpf == "44444444444" 
                || cpf == "55555555555" 
                || cpf == "66666666666" 
                || cpf == "77777777777" 
                || cpf == "88888888888" 
                || cpf == "99999999999"
            ) {
                return false; }
            // Valida 1o digito
            add = 0;
            for (i=0; i < 9; i ++) {
                add += parseInt(cpf.charAt(i)) * (10 - i); }
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11) {
                rev = 0; }
            if (rev != parseInt(cpf.charAt(9))) {
                return false; }
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i ++) {
                add += parseInt(cpf.charAt(i)) * (11 - i); }
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11) {
                rev = 0; }
            if (rev != parseInt(cpf.charAt(10))) {
                return false; }
            return true;
        }

        $("#cpf_funcionario").keypress(
            function() {
                var cpf = $("#cpf_funcionario").val();
                var valor =  cpf.replace(/[^\d]+/g, "");


                if(valor.length == 11) {
                    var valida =validarCPF(valor);
                    if(valida==false) {

                        $("add-alerts").hide();

                        $(document).trigger(
                            "add-alerts", {
                                message: "CPF Inválido!!",
                                priority: "warning"
                            }
                        );
                    }

                }

            }
        );



    }
);