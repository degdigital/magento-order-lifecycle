<?php

class DEG_OrderLifecycle_Model_Observer {

    public function lifecycleEventToRegistry($observer){
        $event = Mage::getSingleton('deg_orderlifecycle/lifecycle_event_factory')->getEventDataObject();
        $eventData = $observer->getEventData();
        $event->setData($eventData->getData());
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        if (!$collection){
            $collection = Mage::getModel('deg_orderlifecycle/lifecycle_event_collection');
        }
        $collection->addEvent($event);
        Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        Mage::register(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION, $collection);
    }

    public function orderSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getObject();
        $adapter->flush($order);
    }

    public function invoiceSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getObject()->getOrder();
        $adapter->flush($order);
    }

    public function paymentSavedEventFlush($observer){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $observer->getObject()->getOrder();
        $adapter->flush($order);
    }
}