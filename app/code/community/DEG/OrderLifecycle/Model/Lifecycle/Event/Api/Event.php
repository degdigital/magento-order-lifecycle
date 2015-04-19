<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Api_Event extends DEG_OrderLifecycle_Model_Lifecycle_Event {

    protected $_eventType = 'Api';

    protected function _initData()
    {
        $apiUser = Mage::getSingleton('api/session')->getUser();
        $this->setUserId($apiUser->getUserId());
        $this->setUsername($apiUser->getUsername());
        $this->setEmail($apiUser->getEmail());
        $this->setFirstname($apiUser->getFirstname());
        $this->setLastname($apiUser->getLastname());
    }

}