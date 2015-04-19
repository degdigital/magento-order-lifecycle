<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Factory {
    public function getWriteAdapter(){
        return Mage::getModel('deg_orderlifecycle/write_adapter_order_history');
    }
}