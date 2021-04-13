<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'base.php';
class empresa extends base
{
    public function getAll ()
    {
        $db = new PDO($this->DRIVER . ':host=' . $this->HOST . ';dbname=' . $this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $result = $db->query("SELECT * FROM empresas");
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = null;
        }
        return $result;
    }

    public function create ($model = [])
    {
        $db = new PDO($this->DRIVER.':host='.$this->HOST.';dbname='.$this->BASE, $this->USER, $this->PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "INSERT INTO empresas (UF, NOMEFANTASIA, CNPJ) VALUES (?, ?, ?)";
        $db->beginTransaction();
            $result = $db->prepare($sql);
            if(! $result->execute(array($model['UF'], $model['NOMEFANTASIA'], $model['CNPJ'])))
            {
                print_r($result->errorInfo());
                exit();
            }
        $db->commit();
    }

    public function getById ($ID)
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