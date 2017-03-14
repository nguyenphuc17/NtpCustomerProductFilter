<?php

class Excercise_Customerpage_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Array of available orders to be used for sort by
     *
     * @return array
     */
    public function getAvailableOrders()
    {
        return array(
            // attribute name => label to be used
            'price' => $this->__('Price')
        );
    }

    /**
     * Return product collection to be displayed by our list block
     *
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function getProductCollection()
    {
        $minprice = Mage::app()->getRequest()->getParam('minprice');
        $maxprice = Mage::app()->getRequest()->getParam('maxprice');
        // validation backend
        if($minprice>=$maxprice || $maxprice>$minprice*5){
            return null;
        }
        $rootCategoryId = Mage::app()->getStore()->getRootCategoryId();

        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite($rootCategoryId)
            ->joinField('qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left');
        if(!empty($minprice) && !empty($maxprice)) {
            $select = $collection->getSelect();
            $select->where('price_index.final_price >= ' . $minprice);
            $select->where('price_index.final_price < ' . $maxprice);
        }
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        return $collection;
    }

}