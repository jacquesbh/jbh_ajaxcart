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

// The Cart Controller is required
require_once 'Mage/Checkout/controllers/CartController.php';

/**
 * Index Controller
 * @package Jbh_AjaxCart
 */
class Jbh_AjaxCart_IndexController extends Mage_Checkout_CartController
{

// Jacques Bodin-Hullin Tag NEW_CONST

// Jacques Bodin-Hullin Tag NEW_VAR

    /**
     * Change the layout render
     * @access protected
     * @return Jbh_AjaxCart_IndexController
     */
    protected function _changeRenderLayout($flag = true)
    {
        $this->setFlag('', 'no-renderLayout', (bool) !$flag);
        return $this;
    }

    /**
     * Initialize product instance from request data
     *
     * @return Mage_Catalog_Model_Product || false
     */
    protected function _initProduct()
    {
        if (null === $product = Mage::registry('current_product')) {
            $product = parent::_initProduct();
            Mage::register('current_product', $product);
        }
        return $product;
    }

    /**
     * Display the json cart
     * @access public
     * @return void
     */
    public function indexAction()
    {
        // Disable the render layout
        $this->_changeRenderLayout(false);

        // Call the parent without the render layout
        parent::indexAction();

        // Re-activate the render layout
        $this->_changeRenderLayout(true);

        // Remove the output for the root block
        $this->getLayout()->removeOutputBlock('root');

        // Display our page (with specific templates)
         $this->renderLayout('ajaxcart');
    }

    /**
     * Add a product to cart
     * @access public
     * @return void
     */
    public function addAction()
    {
        // Disable the redirect
        $this->_getSession()->setNoCartRedirect(true);

        // Call the parent
        parent::addAction();

        // Remove the output for the root block
        $this->loadLayout();
        $this->getLayout()->removeOutputBlock('root');

        // Display our page (with specific templates)
        $ajaxcart = $this->getLayout()->getBlock('ajaxcart');
        $ajaxcart->assign(array(
            'product' => $this->_initProduct(),
            'success' => Mage::registry('product_added_successfully', false)
        ));
        $this->renderLayout('ajaxcart');
    }

    /**
     * Update a product in cart
     * @access public
     * @return void
     */
    public function updateAction()
    {
        // Code here
    }

    /**
     * Remove a product from cart
     * @access public
     * @return void
     */
    public function removeAction()
    {
        // Code here
    }

// Jacques Bodin-Hullin Tag NEW_METHOD

}
