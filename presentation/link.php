<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of link
 *
 * @author Huy
 */
class Link {
    
    private function __construct() {
    }
    
    public static function Build($link)
    {
        $base = 'http://' . getenv('SERVER_NAME');
        
        // If HTTP_SERVER_PORT is defined and different than default
        if(defined('HTTP_SERVER_PORT') && HTTP_SERVER_PORT != '80')
        {
            // Append server port
            $base .= ':' . HTTP_SERVER_PORT;
        }
        
        $link = $base . VIRTUAL_LOCATION . $link;
        
        // Escape HTML
        return htmlspecialchars($link, ENT_QUOTES);
    }
    
    public static function ToDepartment($departmentId,$page = 1)
    {
        $link = 'index.php?DepartmentId=' . $departmentId;
        
        if($page > 1)
            $link .= '&Page=' . $page;
        
        return self::Build($link);
    }
    
    public static function ToCategory($departmentId,$categoryId,$page = 1)
    {
        $link = 'index.php?DepartmentId=' . $departmentId.'&CategoryId=' .$categoryId;
        
        if($page > 1)
            $link .= '&Page=' . $page;
        
        return self::Build($link);
    }
    
    public static function ToIndex($page = 1)
    {
        $link = '';
        
        if($page > 1)
            $link .= 'index.php?Page=' . $page;
        
        return self::Build($link);
    }
    
    public static function ToProduct($productId)
    {
        return self::Build('index.php?ProductId=' . $productId);
    }
    
    public static function QueryStringToArray($queryString)
    {
        $result = array();
        if ($queryString != '')
        {
            //A=a&B=b --> ['A=a','B=b']
            $elements = explode('&', $queryString);
            foreach($elements as $key => $value)
            {
                $element = explode('=', $value);
                //A+B+C=a+b+C --> ['A B C','a b c']
                $result[urldecode($element[0])] = 
                isset($element[1]) ? urldecode($element[1]) : '';
            }
        }
        return $result;
    }
}
