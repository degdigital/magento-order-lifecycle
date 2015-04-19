<?php

class DEG_OrderLifecycle_Model_Observer {

    public function lifecycleEventToRegistry($event){
        $lifecycleEvent = Mage::getSingleton('deg_orderlifecycle/lifecycle_event_factory')->getEventDataObject();
        $eventData = $event->getDataObject();
        $lifecycleEvent->addData($eventData->getData());
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        if (!$collection){
            $collection = Mage::getModel('deg_orderlifecycle/lifecycle_event_collection');
        }
        $collection->addEvent($lifecycleEvent);
        Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        Mage::register(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION, $collection);
    }

    public function orderSavedEventFlush($event){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $event->getDataObject();
        $adapter->flush($order, 'order');
    }

    public function invoiceSavedEventFlush($event){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $event->getDataObject()->getOrder();
        $adapter->flush($order, 'invoice');
    }

    public function paymentSavedEventFlush($event){
        $adapter = Mage::getSingleton('deg_orderlifecycle/write_adapter_factory')->getWriteAdapter();
        $order = $event->getDataObject()->getOrder();
        $adapter->flush($order, 'payment');
    }
}