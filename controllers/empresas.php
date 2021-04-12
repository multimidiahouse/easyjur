<?php
class EmpresaController
{
    public function index ()
    {
        include 'views/empresa/index.php';
    }

    public function create ($model = [])
    {
        include 'models/empresa.php';
        $empresa = new empresa();
        $empresa->create($model);
        header('location: /');        
    }
}
?>