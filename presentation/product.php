<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 * Product detail
 * @author Huy
 */
class Product {
    // Public variables to be ised in smarty template\
    public $mProduct;
    public $mProductLocaltions;
    public $mLinkToContinuesShopping;
    public $mLocation;
    
    // private stuff
    private $_mProductId;
    
    // Class constructor
    public function __construct()
    {
        // Variable initialization
        if(isset($_GET['ProductId']))
            $this->_mProductId = (int)$_GET['ProductId'];
        else
            trigger_error ('ProductId not set');
    }
    
    public function init()
    {
        // Get product details from business tier
        $this->mProduct = Catalog::GetProductDetails($this->_mProductId);
        
        // Session Handle
        if (isset ($_SESSION['link_to_continue_shopping']))
        {
            $continue_shopping =
                Link::QueryStringToArray($_SESSION['link_to_continue_shopping']);
            $page = 1;
            // Cache the current query string. Then after choose the product, we will get back this page.
            if (isset ($continue_shopping['Page']))
                $page = (int)$continue_shopping['Page'];
            if (isset ($continue_shopping['CategoryId']))
                $this->mLinkToContinueShopping =
                    Link::ToCategory((int)$continue_shopping['DepartmentId'],
                        (int)$continue_shopping['CategoryId'], $page);
            elseif (isset ($continue_shopping['DepartmentId']))
                $this->mLinkToContinueShopping =
                    Link::ToDepartment((int)$continue_shopping['DepartmentId'], $page);
            else
                $this->mLinkToContinueShopping = Link::ToIndex($page);
        }
        
        // Product detail
        if($this->mProduct['image'])
            $this->mProduct['image'] =
                Link::Build ('images/product_images/' . $this->mProduct['image']);   
        if($this->mProduct['image_2'])
            $this->mProduct['image_2'] = Link::Build ('images/product_images/' . $this->mProduct['image_2']);
        
        $this->mProduct['attributes'] =
            Catalog::GetProductAttributes($this->mProduct['product_id']);
        
        // Similar products in catalog
        $this->mLocations = Catalog::GetProductLocations($this->_mProductId);
        // Build links for product departments and categories pages
        for ($i = 0; $i < count($this->mLocations); $i++)
        {
            $this->mLocations[$i]['link_to_department'] =
                Link::ToDepartment($this->mLocations[$i]['department_id']);
            $this->mLocations[$i]['link_to_category'] =
                Link::ToCategory($this->mLocations[$i]['department_id'],
                    $this->mLocations[$i]['category_id']);
        }
    }
}
