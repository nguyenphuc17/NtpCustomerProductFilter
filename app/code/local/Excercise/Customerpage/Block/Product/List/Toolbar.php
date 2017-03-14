<?php
/**
 * Created by PhpStorm.
 * User: NTP
 * Date: 2/11/2017
 * Time: 7:13 PM
 */

class Excercise_Customerpage_Block_Product_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar{
    public function setCurrentLimitValue($limit)
    {
        $this->setData('_current_limit', $limit);
    }
}