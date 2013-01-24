<?php
/**
 * This file is part of Jbh_AjaxCart for Magento.
 *
 * @license Lesser General Public License v3 (http://www.gnu.org/licenses/lgpl-3.0.txt)
 * @author Jacques Bodin-Hullin <jacques@bodin-hullin.net>
 * @category Jbh
 * @package Jbh_AjaxCart
 * @copyright Copyright (c) 2013 Jacques Bodin-Hullin (http://jacques.sh/)
 */

/**
 * Observer Model
 * @package Jbh_AjaxCart
 */
class Jbh_AjaxCart_Model_Observer extends Mage_Core_Model_Abstract
{

// Jacques Bodin-Hullin Tag NEW_CONST

// Jacques Bodin-Hullin Tag NEW_VAR

    /**
     * When a product is added
     * @event checkout_cart_add_product_complete
     * @access public
     * @return void
     */
    public function addProductComplete(Varien_Event_Observer $observer)
    {
        Mage::register('product_added_successfully', true);
    }

// Jacques Bodin-Hullin Tag NEW_METHOD

}