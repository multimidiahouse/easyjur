<?php
include __DIR__.DIRECTORY_SEPARATOR.'base.php';
class fornecedor extends base
{
    function getAll ()
    {
        $db = new PDO($this->DRIVER . ':host=' . $this->HOST . ';dbname=' . $this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $result = $db->query("SELECT * FROM fornecedores");
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = null;
        }
        return $result;
    }

    function getAllFromEmpresa ($EMPRESA)
    {
        $db = new PDO($this->DRIVER . ':host=' . $this->HOST . ';dbname=' . $this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $result = $db->query("SELECT * FROM fornecedores WHERE EMPRESA = '".$EMPRESA."'");
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = null;
        }
        return $result;
    }

    function create ($model = [])
    {
        $db = new PDO($this->DRIVER . ':host=' . $this->HOST . ';dbname=' . $this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "INSERT INTO fornecedores (EMPRESA, NOME, CPFCNPJ, DATACADASTRO, TELEFONE, RG, DATANASCIMENTO, INSCMUNICIPAL, INSCESTADUAL, UF) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)";
        $db->beginTransaction();
            $result = $db->prepare($sql);
            if(! $result->execute(array($model['EMPRESA'], $model['NOME'], $model['CPFCNPJ'], json_encode($model['TELEFONE']), $model['RG'], (!empty($model['DATANASCIMENTO']) ? $model['DATANASCIMENTO'] : '0000-00-00'), $model['INSCMUNICIPAL'], $model['INSCESTADUAL'], $model['UF'])))
            {
                print_r($result->errorInfo());
                exit();
            }
        $db->commit();
    }

    function getEmpresa ($ID)
    {
        $db = new PDO($this->DRIVER . ':host=' . $this->HOST . ';dbname=' . $this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $result = $db->query("SELECT * FROM empresas WHERE ID = '".$ID."'");
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = null;
        }
        return $result;
    }
}
?>