<?php
/*
 * When declare statements like this 
 * {load_presentation_object filename="product" assign="obj"}
 * smarty will load this file with all the tags declared in the above statements
 * as the array (name and value) of the $params variables
*/

// Plug-in functions inside plug-in files must be named: smarty_type_name
function smarty_function_load_presentation_object($params, $smarty)
{
    //var_dump($smarty);
    
    require_once PRESENTATION_DIR . $params['filename'] . '.php';
    
    $className = str_replace(' ', '', 
            ucfirst(str_replace('_', ' ', 
                    $params['filename'])));
    
    // Create presnetation object
    $obj = new $className();
    if(method_exists($obj, 'init'))
    {
        $obj->init();
    }
    
    // Assign template variable
    $smarty->assign($params['assign'], $obj);
    // $smarty->assign('var', $obj); --> $var can be invoked in tpl using this class
}
