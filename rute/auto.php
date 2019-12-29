<?php
function auto($class){
    $file=ROOT_DIR.DS.'class'.DS.strtolower($class).'.php';
    if(file_exists($file)){ 
        require_once($file);
        return true;
    }
    return false;
}
spl_autoload_register('auto');

