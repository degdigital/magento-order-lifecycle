<?php

interface DEG_OrderLifecycle_Model_Write_Adapter_Interface {

    public function flush(Mage_Sales_Model_Order $order, $historyEntity);

    public function formatEventData(DEG_OrderLifecycle_Model_Lifecycle_Event $event);

}