<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department_list
 * Load list of departments
 * @author Huy
 */

// Manages the departments list
class DepartmentsList {
    /* Public variables available indepartments_list.tpl Smarty template */
    public $mSelectedDepartment = 0;
    public $mDepartments;
    
    // Constructor reads query string parameter
    public function __construct() {
        /* If DepartmentId exists in the query string, we're visiting a department */
        if (isset($_GET['DepartmentId']))
            $this->mSelectedDepartment = (int)$_GET['DepartmentId'];
        elseif (isset($_GET['ProductId']) && isset($_SESSION['link_to_continue_shopping']))
        {
            // Does not choose department --> check department of the product
            $continue_shopping = 
                    Link::QueryStringToArray($_SESSION['link_to_continue_shopping']);
            
            // if yes --> we're visiting this department to continue shopping
            if(array_key_exists('DepartmentId',$continue_shopping))
                    $this->mSelectedDepartment = (int)$continue_shopping['DepartmentId'];
        }
        
    }
    
    /* Calls business tier method to read departments list and create their links */
    public function init()
    {
        // Get the list of departments from the business tier
        $this->mDepartments = Catalog::GetDepartment();
        
        // Create department links. Display at the "Choose a Department" section.
        for ($i = 0; $i < count($this->mDepartments); $i++)
            $this->mDepartments[$i]['link_to_department'] = 
                Link::ToDepartment ($this->mDepartments[$i]['department_id']);
                // old link format
                // 'index.php?DepartmentId=' . $this->mDepartments[$i]['department_id'];
    }

}
