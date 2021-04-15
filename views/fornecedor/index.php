<?php
    include 'models/fornecedor.php';
?>
<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap.min.css" rel="stylesheet">
        <title>Easyjur</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 m-2 p-2">
                    <table class="table table-striped" id="lista">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF / CNPJ</th>
                                <th>Data de Cadastro</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $fornecedores = new fornecedor();
                                foreach ($fornecedores->getAllFromEmpresa($_REQUEST['empresa']) as $fornecedor)
                                {
                                    echo "<tr>\n";
                                    echo "\t\t\t\t\t<td>".$fornecedor['ID']."</td>\n";
                                    echo "\t\t\t\t\t<td>".$fornecedor['NOME']."</td>\n";
                                    echo "\t\t\t\t\t<td>".$fornecedor['CPFCNPJ']."</td>\n";
                                    echo "\t\t\t\t\t<td>".date('d/m/Y H:i:s', strtotime($fornecedor['DATACADASTRO']))."</td>\n";
                                    echo "\t\t\t\t\t<td>".$fornecedor['TELEFONE']."</td>\n";
                                    echo "\t\t\t\t</tr>\n";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'create.php' ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#lista').DataTable({
                    dom: 'Bfrtip',
                    language: { url: '/views/assets/Portuguese-Brasil.json' },
                    buttons: [
                        {
                            text: 'Voltar',
                            action: function () {
                                window.location.href = '/empresas';
                            },
                            className: 'btn btn-primary'
                        },
                        {
                            text: 'Novo',
                            action: function ( e, dt, node, config ) {
                                showModal();
                            },
                            className: 'btn btn-primary'
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

                    if (tamanho == 14)
                    {
                        $.ajax({
                            url: "https://www.receitaws.com.br/v1/cnpj/" + value, 
                            success: function(result) {
                                $("input[name='NOME']").val(result.fantasia);
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
        </script>
    </body>
</html>