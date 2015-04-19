<?php

class DEG_OrderLifecycle_Model_Write_Adapter_Json_Post implements DEG_OrderLifecycle_Model_Write_Adapter_Interface{

    const ADAPTER_JSON_POST = 'deg_orderlifecycle/write_adapter_json_post';

    public function flush(Mage_Sales_Model_Order $order, $historyEntity){
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        //TODO wrap in a transaction
        if ($collection) {
            $url = $this->_getUrl();
            foreach ($collection->getEvents() as $event) {
                $jsonBody = $this->formatEventData($event);

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => $jsonBody,
                    ),
                );
                $context  = $this->_createContext($options);
                $result = $this->_sendRequest($url, $context);
            }
            Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        }
    }

    protected function _getUrl(){
        return Mage::getStoreConfig('sales/order_lifecycle/post_url');
    }

    protected function _createContext($options){
        return stream_context_create($options);
    }

    protected function _sendRequest($url, $context){
        return file_get_contents($url, false, $context);
    }

    public function formatEventData(DEG_OrderLifecycle_Model_Lifecycle_Event $event){
        return json_encode($event->getData());
    }
}