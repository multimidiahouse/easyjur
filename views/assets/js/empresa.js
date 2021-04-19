$(document).ready( function () {
    $('#lista').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        language: { url: '/views/assets/json/Portuguese-Brasil.json' },
        buttons: [
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

    $("#CNPJ").keyup(function () {
        var value = $("#CNPJ").val();
        value = value.replace(/\D/g, "");
        if (value.length == 14)
        {
            $('.preloader').css('display', 'flex');
            $.ajax({
                url: "https://www.receitaws.com.br/v1/cnpj/" + value, 
                success: function(result) {
                    $('.preloader').css('display', 'none');
                    $('#cadastro-form-dados').removeClass('d-none');
                    $("input[name='NOMEFANTASIA']").val(result.fantasia);
                    $('#UF').val(result.uf);
                },
                error: function (request, status, error) {
                    $('.alert').removeClass('d-none').html(request.responseText);
                    $('.preloader').css('display', 'none');
                    $('#cadastro-form-dados').addClass('d-none');
                }
            });
        }
    }).mask('99.999.999/9999-99');

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