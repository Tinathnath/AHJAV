<?php

require_once('./global.php');
//DB BUILDER, AUTO-GENERATING TABLES AND MODELS

/* /!\ WARNING: Running this file will drop and destroy the associated DB. All datas will be lost. /!\   */
try{
Doctrine_Core::dropDatabases();
Doctrine_Core::createDatabases();
Doctrine_Core::generateModelsFromYaml(CFG_DIR.SCHEMA_FILENAME, LIB_DIR.MODELS_DIRNAME, array('generateTableClasses' => true));
Doctrine_Core::createTablesFromModels(LIB_DIR.MODELS_DIRNAME);
}
catch(Exception $e)
{
    echo $e->getMessage();
}