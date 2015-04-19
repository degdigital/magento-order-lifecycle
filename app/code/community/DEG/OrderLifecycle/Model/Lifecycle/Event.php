<?php
abstract class DEG_OrderLifecycle_Model_Lifecycle_Event extends Mage_Core_Model_Abstract {

    protected $_eventType = 'unknown';
    public function initDataObject() {
        $this->setEventType($this->_eventType);
        $this->_initData();
        return $this;
    }

    public function getFormattedEventData()
    {
        $formattedEventData = '';
        foreach ($this->getData() as $key => $value) {
            $formattedEventData = $key .': '. $value . '<br>';
        }

        return $formattedEventData;
    }

    abstract protected function _initData();

}