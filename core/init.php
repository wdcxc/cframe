<?php
function autoloader($className){
    $types = array(
        "Ctr" => APP_CTR_PATH,
        "Mod" => APP_MOD_PATH,
        "Cnf" => APP_CNF_PATH,
        "Cor" => CORE_PATH
    );

    $pre = substr($className,0,3);
    if(in_array($pre,array_keys($types))){
        $fileName = strtolower(substr($className,3)).SUFFIX;
        $filePath = $types[$pre].$fileName;

        if(is_file($filePath)){
            require_once($filePath);
        }else{
            throw new CorException("class file not found",4001);
        }
    }else{
        throw new CorException("class type invalid",4002);
    }
}

spl_autoload_register("autoloader");

$ctr = empty($_GET["ctr"]) ? "index" : $_GET["ctr"];
$act = empty($_GET["act"]) ? "index" : $_GET["act"];
$router = CorRouter::getInstance();
$router->setController($ctr);
$router->setAction($act);
$router->route();

