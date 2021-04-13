<?php
include_once 'models/base.php';
try
{
    $model = new base();
    $db = new PDO($model->DRIVER . ':host=' . $model->HOST, $model->USER, $model->PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbExists = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $model->BASE . "'");
    if (! (bool) $dbExists->fetchColumn()) { $db->query("CREATE DATABASE " . $model->BASE); }
    $db->query("USE " . $model->BASE);
    $query = file_get_contents("db.sql");
    $db->exec($query);
}
catch(PDOException $ex)
{
    exit($ex);
}