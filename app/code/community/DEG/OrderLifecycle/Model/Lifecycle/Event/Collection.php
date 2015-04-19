<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Collection {

    const REGISTRY_LIFECYCLE_EVENT_COLLECTION = 'registry_lifecycle_event_collection';

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