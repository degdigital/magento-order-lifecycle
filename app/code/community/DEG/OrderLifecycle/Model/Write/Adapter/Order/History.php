<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Order_History implements DEG_OrderLifecycle_Model_Write_Adapter_Interface{

    const ADAPTER_ORDER_HISTORY = 'deg_orderlifecycle/write_adapter_order_history';

    public function flush(Mage_Sales_Model_Order $order, $historyEntity){
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        //TODO wrap in a transaction
        if ($collection) {
            foreach ($collection->getEvents() as $event) {
                $comment = $this->formatEventData($event);
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

    public function formatEventData(DEG_OrderLifecycle_Model_Lifecycle_Event $event){
        $formattedEventData = '';
        foreach ($event->getData() as $key => $value) {
            $formattedEventData .= $key .': '. $value . '<br>';
        }

        return $formattedEventData;
    }
}