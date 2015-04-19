<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Frontend_Event extends DEG_OrderLifecycle_Model_Lifecycle_Event {

    protected $_eventType = 'Frontend';

    protected function _initData()
    {
        $remoteIp = Mage::helper('core/http')->getRemoteAddr(true);
        $this->setRemoteIp($remoteIp);
    }

}