<?php


class DEG_OrderLifecycle_Tests_Model_Lifecycle_Event_CollectionTest extends EcomDev_PHPUnit_Test_Case {

    public function testAddEventAndGetEvents(){
        $event1 = new Varien_Object();
        $event1->setTestValue('test1');
        $event2 = new Varien_Object();
        $event2->setTestValue('test2');
        $collection = new DEG_OrderLifecycle_Model_Lifecycle_Event_Collection();
        $this->assertEquals(0, sizeof($collection->getEvents()));
        $collection->addEvent($event1);
        $collection->addEvent($event2);
        $this->assertEquals(2, sizeof($collection->getEvents()));
    }

    public function testResetEvents(){
        $event1 = new Varien_Object();
        $event1->setTestValue('test1');
        $event2 = new Varien_Object();
        $event2->setTestValue('test2');
        $collection = new DEG_OrderLifecycle_Model_Lifecycle_Event_Collection();
        $this->assertEquals(0, sizeof($collection->getEvents()));
        $collection->addEvent($event1);
        $collection->addEvent($event2);
        $this->assertEquals(2, sizeof($collection->getEvents()));
        $collection->resetEvents();
        $this->assertEquals(0, sizeof($collection->getEvents()));
    }

}