<?php
/**
 * Luxe 
 * MostViewed module
 *
 * @category   Luxe
 * @package    Luxe_MostViewed
 */


class Bippo_MostViewedProducts_Model_Config_Source_ListMode
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'grid', 'label'=>Mage::helper('adminhtml')->__('Grid')),
            array('value'=>'list', 'label'=>Mage::helper('adminhtml')->__('List')),
        );
    }
}
