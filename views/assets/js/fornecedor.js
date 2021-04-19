$(document).ready( function () {
    $('#lista').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        language: { url: '/views/assets/json/Portuguese-Brasil.json' },
        buttons: [
            {
                text: 'Voltar',
                action: function () {
                    window.location.href = '/empresas';
                },
                className: 'btn btn-secondary'
            },
            {
                text: 'Novo',
                action: function ( e, dt, node, config ) {
                    showModal();
                },
                className: 'btn btn-secondary'
            }
        ]
    });

    window.showModal = function ()
    {
        $('#cadastro').modal('show');
    };

    window.hideModal = function ()
    {
        $('#cadastro').modal('hide');
    };

    $("#CPFCNPJ").keyup(function(){
        var value = $("#CPFCNPJ").val();
        value = value.replace(/\D/g, "");
        var tamanho = value.length;

        if (tamanho == 11) {
            if(!validaCPF(value)) $("#CPFCNPJ").addClass('is-invalid');
            else $("#CPFCNPJ").removeClass('is-invalid');

            $("#ADICIONALPJ").hide();
            $("#ADICIONALPF").show();
            $("#RG").attr('required', '');
            $("#DATANASCIMENTO").attr('required', '');
        }

        if (tamanho > 11) {
            $("#ADICIONALPF").hide();
            $("#CPFCNPJ").removeClass('is-invalid');

            $("#RG").removeAttr('required');
            $("#DATANASCIMENTO").removeAttr('required');

            $("#ADICIONALPJ").show();
            if ($("#UF").val() == 'DF')
            {
                $("#INSCESTADUAL").show();
                $("input[name='INSCESTADUAL']").attr('required', '');
            }
            else
            {
                $("#INSCMUNICIPAL").show();
                $("input[name='INSCMUNICIPAL']").attr('required', '');
            }
        }

        $("#UF").on('change', function () {
            if ($("#UF").val() == 'DF')
            {
                $("#INSCMUNICIPAL").hide().val('-');
                $("input[name='INSCMUNICIPAL']").removeAttr('required');
                $("#INSCESTADUAL").show();
                $("input[name='INSCESTADUAL']").attr('required', '');
            }
            else
            {
                $("#INSCESTADUAL").hide().val('-');
                $("input[name='INSCESTADUAL']").removeAttr('required');
                $("#INSCMUNICIPAL").show();
                $("input[name='INSCMUNICIPAL']").attr('required', '');
            }
        });

        if (tamanho == 14)
        {
            $('.preloader').css('display', 'flex');
            $.ajax({
                url: "https://www.receitaws.com.br/v1/cnpj/" + value, 
                success: function(result) {
                    $('.preloader').css('display', 'none');
                    $("input[name='NOME']").val(result.fantasia);
                    $('#UF').val(result.uf);
                },
                error: function (request, status, error) {
                    $('.alert').removeClass('d-none').html(request.responseText);
                    $('.preloader').css('display', 'none');
                }
            });
        }
    });

    window.validaCPF = function(CPF)
    {
        var Soma;
        var Resto;
        Soma = 0;
        if (CPF == "00000000000") return false;

        for (i=1; i<=9; i++) Soma = Soma + parseInt(CPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(CPF.substring(9, 10)) ) return false;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(CPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(CPF.substring(10, 11) ) ) return false;
        return true;
    };

    window.somenteNumeros = function (e) 
    {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        if (charCode != 8 && charCode != 9) {
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    };

});