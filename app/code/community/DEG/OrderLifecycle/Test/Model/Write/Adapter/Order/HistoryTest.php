<?php


class DEG_OrderLifecycle_Tests_Model_Write_Adapter_Order_HistoryTest extends EcomDev_PHPUnit_Test_Case {

    public function testFlush(){
        $event1 = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $collection = new DEG_OrderLifecycle_Model_Lifecycle_Event_Collection();
        $collection->addEvent($event1);

        Mage::register(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION, $collection);
        $adapter = new DEG_OrderLifecycle_Model_Write_Adapter_Order_History();

        $order = $this->mockModel('sales/order',array('getStatus','getId'));
        $order->expects($this->any())->method('getStatus')->will($this->returnValue('Complete'));
        $order->expects($this->any())->method('getId')->will($this->returnValue(12));


        $history = $this->mockModel('sales/order_status_history',array('setParentId','setStatus','setComment','setIsCustomerNotified','setIsVisibleOnFront','setEntityName','save'));
        $history->expects($this->once())->method('setParentId')->with($this->equalTo(12));
        $history->expects($this->once())->method('setStatus')->with($this->equalTo('Complete'));
        $history->expects($this->once())->method('setComment')->with($this->equalTo(''));
        $history->expects($this->once())->method('setIsCustomerNotified')->with($this->equalTo(0));
        $history->expects($this->once())->method('setIsVisibleOnFront')->with($this->equalTo(0));
        $history->expects($this->once())->method('setEntityName')->with($this->equalTo('order'));
        $history->expects($this->once())->method('save');
        $this->replaceByMock('model', 'sales/order_status_history', $history);

        $adapter->flush($order->getMockInstance(), 'order');

        $this->assertNull(Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION));

    }

    public function testFormatEventData()
    {
        $adapter = new DEG_OrderLifecycle_Model_Write_Adapter_Order_History();
        $adminEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $adminEvent->setUsername('name');
        $adminEvent->setEmail('email');
        $formattedData = $adapter->formatEventData($adminEvent);
        $this->assertEquals($formattedData, 'username: name<br>email: email<br>');
    }

    public function tearDown(){
        Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);

    }

}