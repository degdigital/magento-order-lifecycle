<?php

class DEG_OrderLifecycle_Model_Hooks {

    public function orderAfterSaveLifecycleEvent($event){
        $order = $event->getDataObject();
        $newStatus = $order->getData('status');
        $oldStatus = $order->getOrigData('status');
        if ($newStatus != $oldStatus) {
            $object = new Varien_Object();
            $object->setOldStatus($oldStatus);
            $object->setNewStatus($newStatus);
            Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
        }
    }

    public function preDispatch($event){
        Mage::dispatchEvent('lifecycle_event', array('data_object' => new Varien_Object()));
    }

    public function paymentCaptureLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Captured Order');
        Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
    }

    public function paymentRefundLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Refunded Order');
        Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
    }

    public function invoiceCreatedLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Invoice Created');
        Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
    }

    public function shippmentCreatedLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Shippment Created');
        Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
    }

}