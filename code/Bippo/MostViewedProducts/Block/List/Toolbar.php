<?php
/**
 * Luxe 
 * MostViewed module
 *
 * @category   Luxe
 * @package    Luxe_MostViewed
 */

/**
 * Product list toolbar
 *
 * @category    Luxe 
 * @package     Luxe_MostViewed
 * @author      Yuriy V. Vasiyarov
 */
class Bippo_MostViewedProducts_Block_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar 
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('bippomostviewedproducts/list/toolbar.phtml');
    }

    public function getCurrentMode()
    {
        return Mage::getStoreConfig('mostviewed/mostviewed/list_mode');
    }

    public function getLimit()
    {
        return intval(Mage::getStoreConfig('mostviewed/mostviewed/num_displayed_products'));
    }
}
