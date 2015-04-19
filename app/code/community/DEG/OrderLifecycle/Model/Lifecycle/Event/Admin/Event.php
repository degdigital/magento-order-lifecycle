<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event extends DEG_OrderLifecycle_Model_Lifecycle_Event {

    protected $_eventType = 'Admin';

    protected function _initData()
    {
        /** @var Mage_Admin_Model_User $admin */
        $admin = Mage::getSingleton('admin/session')->getUser();
        $this->setUserId($admin->getUserId());
        $this->setUsername($admin->getUsername());
        $this->setEmail($admin->getEmail());
        $this->setFirstname($admin->getFirstname());
        $this->setLastname($admin->getLastname());

        $adminSessionQuote = Mage::getSingleton('adminhtml/session_quote');
        if ($adminSessionQuote->getReordered()) {
            $reorderId = $adminSessionQuote->getReordered();
            $this->setReorderPreviousOrderId($reorderId);
        }
    }

}