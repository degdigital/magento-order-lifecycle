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
}