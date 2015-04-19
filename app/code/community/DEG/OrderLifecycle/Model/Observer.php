<?php

class DEG_OrderLifecycle_Model_Observer {
    public function lifecycleEventToRegistry($observer){
        //create event factory
        //get event
        //set info into event
        //set event into the collection in registry
    }

    public function orderSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getOrder();
        $adapter->flush($order);
    }

    public function invoiceSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getInvoice()->getOrder();
        $adapter->flush($order);
    }

    public function paymentSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getPayment()->getOrder();
        $adapter->flush($order);
    }
}