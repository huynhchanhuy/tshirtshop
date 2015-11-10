<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department
 * Load department detail
 * @author Huy
 */
class Department {
    // public variables for the smarty template
    public $mName;
    public $mDescription;
    
    // private members
    private $_mDepartmentId;
    private $_mCategoryId;
    
    // Class constructor
    public function __construct()
    {
        // We need to have DepartmnetId in the query string
        if(isset($_GET['DepartmentId']))
            $this->_mDepartmentId = (int)$_GET['DepartmentId'];
        else
            trigger_error ('DepartmentId does not set');
        
        /* If CategoryId is in the query string we save it
            (casting it to interger to protect against invalid values)  */
        if (isset($_GET['CategoryId']))
            $this->_mCategoryId = (int)($_GET['CategoryId']);
    }
    
    public function init()
    {
        // If visiting a department...
        $department_details = 
                Catalog::GetDepartmentDetails($this->_mDepartmentId);
        
        $this->mName  = $department_details['name'];
        $this->mDescription = $department_details['description'];
        if (isset($this->_mCategoryId))
        {
            // If visiting a category...
            $category_details = 
                    Catalog::GetCategoryDetails($this->_mCategoryId);
            
            // Header title
            $this->mName .= ' &raquo; ' . $category_details['name'];
            // Description
            $this->mDescription = $category_details['description'];
        }
    }
}
