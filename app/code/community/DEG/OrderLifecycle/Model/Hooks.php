<?php

class DEG_OrderLifecycle_Model_Hooks {

    public function orderBeforeSaveLifecycleEvent($event){
        $order = $event->getDataObject();
        $newState = $order->getData('state');
        $oldState = $order->getOrigData('state');
        if ($newState != $oldState) {
            $object = new Varien_Object();
            $object->setOldState($oldState);
            $object->setNewState($newState);
            Mage::dispatchEvent('lifecycle_event', array('data_object' => $object));
        }
    }
}