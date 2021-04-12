<?php
    include 'models/empresa.php';
?>
<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
        <title>Easyjur</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 m-2 p-2">
                    <table class="table" id="lista">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UF</th>
                                <th>Nome Fantasia</th>
                                <th>CNPJ</th>
                                <th>Fornecedores</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $empresas = new empresa();
                                foreach ($empresas->getAll() as $empresa)
                                {
                                    echo "<tr>\n";
                                    echo "\t\t\t\t\t<td>".$empresa['ID']."</td>\n";
                                    echo "\t\t\t\t\t<td>".$empresa['UF']."</td>\n";
                                    echo "\t\t\t\t\t<td>".$empresa['NOMEFANTASIA']."</td>\n";
                                    echo "\t\t\t\t\t<td>".$empresa['CNPJ']."</td>\n";
                                    echo "\t\t\t\t\t<td><a href='/fornecedores/?empresa=".$empresa['ID']."'><svg style='width:20px;height:auto;' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='truck' class='svg-inline--fa fa-truck fa-w-20' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><path fill='currentColor' d='M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z'></path></svg></a></td>\n";
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
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#lista').DataTable({
                    dom: 'Bfrtip',
                    language: { url: '/views/assets/Portuguese-Brasil.json' },
                    buttons: [
                        {
                            text: 'Novo',
                            action: function ( e, dt, node, config ) {
                                showModal();
                            }
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

                window.salvarEmpresa = function () {
                    $('#cadastro-form').submit();
                };

                $("#CNPJ").keyup(function () {
                    var value = $("#CNPJ").val();
                    value = value.replace(/\D/g, "");
                    if (value.length == 14)
                    {
                        $.ajax({
                            url: "https://www.receitaws.com.br/v1/cnpj/" + value, 
                            success: function(result) {
                                $("input[name='NOMEFANTASIA']").val(result.fantasia);
                            }
                        });
                    }
                });

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