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
        <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet" >
        <link href="/views/assets/css/main.css" rel="stylesheet">
        <title>Easyjur</title>
    </head>
    <body>
        <div class="preloader">
            <img src="/views/assets/svg/preloader.svg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 ml-2 mt-2 mr-2 mb-2 pl-2 pt-2 pr-2 pb-2">
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
        <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
        <script src="/views/assets/js/fornecedor.js"></script>
    </body>
</html>