<?php
abstract class DEG_OrderLifecycle_Model_Lifecycle_Event extends Mage_Core_Model_Abstract {

    //Data: created_at
    public function initDataObject() {
        //$this->setCreatedAt();

        $this->_initData();
        return $this;
    }

    abstract protected function _initData();

    abstract public function getFormattedEventData();
}