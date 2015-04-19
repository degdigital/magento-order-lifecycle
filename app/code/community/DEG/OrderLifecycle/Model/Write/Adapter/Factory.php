<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Factory {

    /**
     * @return DEG_OrderLifecycle_Model_Write_Adapter_Interface
     */
    public function getWriteAdapter(){
        $adapterModelSource = Mage::getStoreConfig('sales/order_lifecycle/adapter');
        return Mage::getModel($adapterModelSource);
    }
}