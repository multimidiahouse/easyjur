<?php
    include 'controllers/empresas.php';
    include 'controllers/fornecedores.php';
    switch ($_SERVER['PATH_INFO'])
    {
        case '/empresas':
            $empresa = new EmpresaController();
            $empresa->index();
            break;
        case '/empresas/create':
            $empresa = new EmpresaController();
            $empresa->create($_POST);
            break;
        case '/fornecedores/':
            $fornecedor = new FornecedorController();
            $fornecedor->index();
            break;
        case '/fornecedores/create':
            $fornecedor = new FornecedorController();
            $fornecedor->create($_POST);
            break;
        default:
            $empresa = new EmpresaController();
            $empresa->index();
    }
?>