<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Order_History {
    public function flush($order, $historyEntity){
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        //TODO wrap in a transaction
        if ($collection) {
            foreach ($collection->getEvents() as $event) {
                $comment = $event->getFormattedEventData();
                $history = Mage::getModel('sales/order_status_history');
                $history->setParentId($order->getId());
                $history->setStatus($order->getStatus());
                $history->setComment($comment);
                $history->setIsCustomerNotified(0);
                $history->setIsVisibleOnFront(0);
                $history->setEntityName($historyEntity);
                $history->save();
            }
            Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        }
    }
}