<?php

class DEG_OrderLifecycle_Model_Hooks {

    public function orderAfterSaveLifecycleEvent($event){
        $order = $event->getDataObject();
        $newState = $order->getData('state');
        $oldState = $order->getOrigData('state');
        $newStatus = $order->getData('status');
        $oldStatus = $order->getOrigData('status');
        if (($newState != $oldState) || ($newStatus != $oldStatus)) {
            $object = new Varien_Object();
            if (($newState != $oldState)) {
                $object->setOldState($oldState);
                $object->setNewState($newState);
            }
            if (($newStatus != $oldStatus)) {
                $object->setOldStatus($oldState);
                $object->setNewStatus($newState);
            }
            Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
        }
    }
}