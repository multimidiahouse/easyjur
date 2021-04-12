<?php
class FornecedorController
{
    public function index ()
    {
        include 'views/fornecedor/index.php';
    }

    public function create ($model = [])
    {
        include 'models/fornecedor.php';
        $fornecedor = new fornecedor();
        $empresa = $fornecedor->getEmpresa($model['EMPRESA'])[0];
        if ($empresa['UF'] == 'PR')
        {
            if (strlen(preg_replace('/\D/', '', $model['CPFCNPJ'])) <= 11)
            {
                $idade = date_diff(date_create($model['DATANASCIMENTO']), date_create(date('Y-m-d')));
                if ((int) $idade->format("%y") < 18) echo 'Não é permitido o cadastro de fornecedores menores de 18 anos';
                sleep(3);
                header('location: /fornecedores/?empresa=' . $model['EMPRESA']);
            }
        }
        $fornecedor->create($model);
        header('location: /fornecedores/?empresa=' . $model['EMPRESA']);
    }
}
?>