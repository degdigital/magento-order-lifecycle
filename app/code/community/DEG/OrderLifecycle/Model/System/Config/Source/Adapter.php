<?php

class DEG_OrderLifecycle_Model_System_Config_Source_Adapter
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => DEG_OrderLifecycle_Model_Write_Adapter_Order_History::ADAPTER_ORDER_HISTORY, 'label'=>Mage::helper('deg_orderlifecycle')->__('Order History')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            DEG_OrderLifecycle_Model_Write_Adapter_Order_History::ADAPTER_ORDER_HISTORY => Mage::helper('deg_orderlifecycle')->__('Order History'),
        );
    }

}
