<?php
/**
 * Luxe
 * MostViewed module
 *
 * @category   Luxe 
 * @package    Luxe_MostViewed
 */


/**
 * Product list
 *
 * @category   Luxe
 * @package    Luxe_MostViewed
 * @author     Yuriy V. Vasiyarov
 */
class Bippo_MostViewedProducts_Block_List extends Mage_Catalog_Block_Product_List 
{
    protected $_defaultToolbarBlock = 'mostviewed/list_toolbar';
    
    protected function _construct()
    {
    	parent::_construct();
    	$this->setTemplate('bippomostviewedproducts/grid.phtml');
    }

    public function getTimeLimit() 
    {
        return intval(Mage::getStoreConfig('mostviewed/mostviewed/time_limit_in_days'));
    }

    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $this->setStoreId($storeId);
        if (is_null($this->_productCollection)) {
            $this->_productCollection = Mage::getResourceModel('reports/product_collection');

            if ($this->getTimeLimit()) {
                $product = Mage::getModel('catalog/product');
                $todayDate = $product->getResource()->formatDate(time());
                $startDate = $product->getResource()->formatDate(time() - 60 * 60 * 24 * $this->getTimeLimit());
                $this->_productCollection = $this->_productCollection->addViewsCount($startDate, $todayDate);
            } else {
                $this->_productCollection = $this->_productCollection->addViewsCount();
            }        
            $statuses = Mage::getSingleton('catalog/product_status')->getVisibleStatusIds();
            $this->_productCollection = $this->_productCollection->addAttributeToSelect('*')
                            ->setStoreId($storeId)
                            ->addStoreFilter($storeId)
                            ->addAttributeToFilter('status', $statuses)
                            ->setPageSize($this->getToolbarBlock()->getLimit());

        }
        $this->_productCollection->load();
        return $this->_productCollection;
    }

    public function _toHtml()
    {
        if ($this->_productCollection->count()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    } 

    /**
     * Translate block sentence
     *
     * @return string
     */
    public function __()
    {
        $args = func_get_args();
        $expr = new Mage_Core_Model_Translate_Expr(array_shift($args), 'Mage_Catalog');
        array_unshift($args, $expr);
        return Mage::app()->getTranslator()->translate($args);
    }

}
