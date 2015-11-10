<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of store_front
 *
 * @author Huy
 */
class StoreFront 
{
    public $mSiteUrl;

    // Define the default template file for the page contents
    public $mContentsCell = 'first_page_contents.tpl';
    // Define the default template file for the categories contents
    public $mCategoriesCell = 'blank.tpl';
    // Define the default template file for the departments list contents
    public $mDepartmentsCell = 'departments_list.tpl';
    
    // Class constructor
    public function __construct() {
        $this->mSiteUrl = Link::Build('');
    }
    
    // Initialize presentation object
    public function init()
    {
        // Load department details if visiting a department
        if (isset($_GET['DepartmentId']))
        {
            // Department detail (the right section of webpage) and categories detail if so.
            $this->mContentsCell = 'department.tpl';
            // List of categories following department id
            $this->mCategoriesCell = 'categories_list.tpl';
        }
        elseif (isset($_GET['ProductId']) && 
            isset($_SESSION['link_to_continue_shopping']) &&
                strpos($_SESSION['link_to_continue_shopping'], 'DepartmentId', 0) !== false)
        {
            $this->mCategoriesCell = 'categories_list.tpl';
        }
        // Load product details page if visiting a product
        if (isset ($_GET['ProductId']))
            $this->mContentsCell = 'product.tpl';
    }
}
