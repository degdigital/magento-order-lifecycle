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
            $this->_dispatchEvent('lifecycle_event', $object);
        }
    }

    public function paymentCaptureLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Captured Payment');
        $this->_dispatchEvent('lifecycle_event', $object);
    }

    public function paymentRefundLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Refunded Order');
        $this->_dispatchEvent('lifecycle_event', $object);
    }

    public function invoiceCreatedLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Invoice Created');
        $this->_dispatchEvent('lifecycle_event', $object);
    }

    public function shippmentCreatedLifecyceEvent($event){
        $object = new Varien_Object();
        $object->setMessage('Shippment Created');
        $this->_dispatchEvent('lifecycle_event', $object);
    }

    protected function _dispatchEvent($eventName, $data){
        Mage::dispatchEvent($eventName, array('data_object' => $data));
    }


}