<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of products_list
 * Return list of products
 * @author Huy
 */
class ProductsList {
    // Public variables to be read from Smarty template
    public $mPage=1;
    public $mrTotalPages;
    public $mLinkToPreviousPage;
    public $mLinkToNextPage;
    public $mProducts;
    
    // Private members;
    private $_mDepartmentId;
    private $_mCategoryId;
    
    // Class contruction
    public function __construct()
    {
        // Get DepartmentId from query string casting it to int
        if (isset($_GET['DepartmentId']))
            $this->_mDepartmentId = (int)$_GET['DepartmentId'];
   
        // Get DepartmentId from query string casting it to int
        if(isset($_GET['CategoryId']))
            $this->_mCategoryId = (int)$_GET['CategoryId'];
        
        // Get Page number from query string casting it to int
        if(isset($_GET['Page']))
            $this->mPage = (int)$_GET['Page'];
        
        if($this->mPage < 1)
            trigger_error ('Incorrect Page value');
        
        // Save page request for continue shopping functionality
        // Because user may choose the product to buy. After that, we will
        // return to this page to continue shopping
        $_SESSION['link_to_continue_shopping'] = $_SERVER['QUERY_STRING'];
    }
    
    public function init()
    {
        /* If browsing a category, get the list of products by calling the
         * GetProductsInCategory() business tier method */
        if(isset($this->_mCategoryId))
            $this->mProducts = Catalog::GetProductsInCategory(
                    $this->_mCategoryId,
                        $this->mPage, $this->mrTotalPages);
        
        /* If browsing a category, get the list of products by calling the
         * GetProductsInCategory() business tier method */
        elseif(isset($this->_mDepartmentId))
            $this->mProducts = Catalog::GetProductsOnDepartment(
                    $this->_mDepartmentId,
                    $this->mPage, $this->mrTotalPages);
        /* If browsing the first page, get the list of products by
        calling the GetProductsOnCatalog() business
        tier method */
        else
            $this->mProducts = Catalog::GetProductsOnCatalog(
                        $this->mPage, $this->mrTotalPages);
        
            /* If there are subpages of products, display navigation
                controls */
            if($this->mrTotalPages > 1)
            {
                // Build the Next link
                if($this->mPage < $this->mrTotalPages)
                {
                   if(isset($this->_mCategoryId))
                       $this->mLinkToNextPage = 
                           Link::ToCategory($this->_mDepartmentId,$this->_mCategoryId,$this->mPage+1);
                   elseif(isset($this->_mDepartmentId))
                       $this->mLinkToNextPage = 
                           Link::ToDepartment($this->_mDepartmentId,$this->mPage+1);
                   else
                       $this->mLinkToNextPage = 
                           Link::ToIndex($this->mPage + 1);
                }
                
                // Build the Previous Link
                if($this->mPage > 1)
                {
                    if(isset($this->_mCategoryId))
                       $this->mLinkToPreviousPage = 
                            Link::ToCategory($this->_mDepartmentId,$this->_mCategoryId,$this->mPage-1);
                   elseif(isset($this->_mDepartmentId))
                       $this->mLinkToPreviousPage = 
                           Link::ToDepartment($this->_mDepartmentId,$this->mPage-1);
                   else
                       $this->mLinkToPreviousPage = 
                           Link::ToIndex($this->mPage - 1);
                }
            }
            
            // Build links for product details pages
            for ($i = 0; $i < count($this->mProducts); $i++) 
            {
                $this->mProducts[$i]['link_to_product'] = 
                    Link::ToProduct($this->mProducts[$i]['product_id']);

                if($this->mProducts[$i]['thumbnail'])
                    $this->mProducts[$i]['thumbnail'] = 
                        Link::Build('images/product_images/'.$this->mProducts[$i]['thumbnail']);
            
                $this->mProducts[$i]['attributes'] =
                    Catalog::GetProductAttributes($this->mProducts[$i]['product_id']);
            }
    }
}
