<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Collection {
    protected $_events = array();

    public function addEvent($event){
        $this->_events[] = $event;
    }

    public function getEvents(){
        return $this->_events;
    }

    public function resetEvents(){
        $this->_events = array();
        return $this;
    }

}