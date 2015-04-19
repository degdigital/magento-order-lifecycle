<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Json_Post implements DEG_OrderLifecycle_Model_Write_Adapter_Interface{

    const ADAPTER_JSON_POST = 'deg_orderlifecycle/write_adapter_json_post';

    public function flush(Mage_Sales_Model_Order $order, $historyEntity){
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        //TODO wrap in a transaction
        if ($collection) {
            $url = Mage::getStoreConfig('sales/order_lifecycle/post_url');
            foreach ($collection->getEvents() as $event) {
                $jsonBody = $this->formatEventData($event);

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => $jsonBody,
                    ),
                );
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
            }
            Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        }
    }

    public function formatEventData(DEG_OrderLifecycle_Model_Lifecycle_Event $event){
        return json_encode($event->getData());
    }
}