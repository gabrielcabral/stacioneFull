/**
 * Created by GABRIEL on 21/10/2015.
 */
jQuery.noConflict();
jQuery(function ($) {

    $('#cpfValidado').hide();
    $('[data-toggle="confirmation"]').confirmation({

        title:"Deseja excluir?",
        btnOkLabel:"<i class='glyphicon glyphicon-ok-circle'></i> Sim",
        btnCancelLabel:"<i class='glyphicon glyphicon-remove-circle'></i> Não",
        delay: { show: 500, hide: 100 },
        onConfirm: function() {
        },
        onCancel: function() {  }
    });

     $( "#inserir" ).click(function() {

     if($("#senha").val()!= ''){
     if($("#senha").val() === $("#cosenha").val()){
     $( "#formFunc").submit();
     }else{
     alert("A senha estão diferentes!");
     return false;
     }
     }else{
     alert("A senha está em branco!")
     return false;
     }
     });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").alert('close');
    });
    $("#btnNovoFuncionario").click(function () {
        window.location.href = "modulo.php?modulo=funcionario&menu=inserir";
    });
    $(".btnAletrar").click(function () {
       // var id = $(this.id).val();

        window.location.href = "modulo.php?modulo=funcionario&menu=alterar&id="+this.id;
    });
    $("#alterarPasss").click(function () {
        if($("#senha").val()!= ''){
            if($("#senha").val() === $("#cosenha").val()){
                $( "#formAlterarSenha").submit();
            }else{
                $(document).trigger("add-alerts", [
                    {
                        'message': "A senha estão diferentes",
                        'priority': 'warning'
                    }
                ]);

                return false;
            }
        }else{
            $(document).trigger("add-alerts", [
                {
                    'message': "A senha está em branco!",
                    'priority': 'warning'
                }
            ]);

            return false;
        }

    });
    $("#salvar").click(function(){

        if($('#nm_funcionario').val() == ''){
            $("#danger").text("Campo nome Obrigatório! ");
            $("#danger").show();
            $("#danger").hide(5000);
            $('#nm_funcionario').onfocus();
            return false;
        }
        if($('#cpf_funcionario').val() == ''){
            $("#danger").text("Campo CPF Obrigatório! ");
            $("#danger").show();
            $("#danger").hide(5000);
            $('#cpf_funcionario').onfocus();
            return false;
        }


        if($("#senha").val()!= ''){
            if($("#senha").val() === $("#cosenha").val()){
                $( "#formFunc").submit();
            }else{
                $("#danger").text("A senha estão diferentes!");
                $("#danger").show();
                $("#danger").hide(5000);
                $('#senha').onfocus();
                return false;
            }
        }else{
            $("#danger").text("A senha está em branco!");
            $("#danger").show();
            $("#danger").hide(5000);
            $('#senha').onfocus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "../public/ajax/funcionario/insert.php",
            data: {
                nm_funcionario:$('#nm_funcionario').val(),
                cpf_funcionario:$('#cpf_funcionario').val(),
                senha:$('#senha').val(),
                rg_funcionario:$('#rg_funcionario').val(),
                login:$('#login').val(),
                perfil:$('#perfil').val(),
            },
            dataType: "json",
            success: function(json){
                $('#nome_cliente').val(json.nome_cliente);
                $('#cpf_cliente').val(json.cpf_cliente);
                $('#id_cliente').val(json.id_cliente);

            }
        });




       /* $("#success").text("Novo conteudo");
        $("#success").show();
        $("#success").hide(10000);*/
    });




    $(".data").mask("99/99/9999");
    $(".telefone").mask("(99)9999-9999");
    $(".mascaraCpf").mask("999.999.999-99");
    $(".cep").mask("99999-999");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".placa").mask("aaa - 9999");





    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g,'');
        if(cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i=0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }

    $( "#cpf_funcionario" ).keypress(function( event ) {
        var cpf = $( "#cpf_funcionario" ).val();
        var valor =  cpf.replace(/[^\d]+/g, "");

        if(valor.length == 11){
            var valida =validarCPF(valor);
            if(valida==false){
                $("#danger").text("CPF Inválido!");
                $("#danger").show();
                $("#danger").hide(5000);

            }else{
                $("#success").text("CPF Válido!");
                $("#success").show();
                $("#success").hide(5000);
            }

        }

    });

    $('#formFunc').submit(function(){

        // show that something is loading
        $('#response').html("<b>Loading response...</b>");

        $.ajax({
            type: 'POST',
            url: 'funcionario/insert.php',
            data: $(this).serialize()
        })
            .done(function(data){

                // show the response
                //$('#response').fadeOut(2000).html(data);
                $('#response').html(data);
                //$( "#divNovoFuncionario").hide();

                //location.reload();
            })

        return false;

    });

});