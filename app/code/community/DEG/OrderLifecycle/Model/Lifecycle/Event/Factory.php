<?php
class DEG_OrderLifecycle_Model_Lifecycle_Event_Factory {

    public function getEventDataObject() {
        $apiRunning = Mage::getSingleton('api/server')->getAdapter() != null;
        if ($apiRunning) {
            return Mage::getModel('deg_orderlifecycle/lifecycle_event_api_event')->initDataObject();
        }else if (Mage::app()->getStore()->isAdmin()) {
            return Mage::getModel('deg_orderlifecycle/lifecycle_event_admin_event')->initDataObject();
        }

        return Mage::getModel('deg_orderlifecycle/lifecycle_event_frontend_event')->initDataObject();
    }
}