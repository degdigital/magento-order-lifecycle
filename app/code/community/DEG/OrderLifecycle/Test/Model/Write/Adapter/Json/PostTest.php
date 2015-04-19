<?php


class DEG_OrderLifecycle_Tests_Model_Write_Adapter_Json_PostTest extends EcomDev_PHPUnit_Test_Case {


    public function testFlush(){

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => '{key:value}',
            ),
        );

        $event1 = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $collection = new DEG_OrderLifecycle_Model_Lifecycle_Event_Collection();
        $collection->addEvent($event1);

        Mage::register(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION, $collection);
        $adapter = $this->mockModel('deg_orderlifecycle/write_adapter_json_post', array('_getUrl','_sendRequest', '_createContext', 'formatEventData'));
        $adapter->expects($this->once())->method('_getUrl')->will($this->returnValue('http://www.example.com'));
        $adapter->expects($this->once())->method('_createContext')->with($this->equalTo($options));
        $adapter->expects($this->once())->method('_sendRequest')->with($this->equalTo('http://www.example.com'));
        $adapter->expects($this->once())->method('formatEventData')->will($this->returnValue('{key:value}'));


        $order = $this->mockModel('sales/order',array('getStatus','getId'));
        $order->expects($this->any())->method('getStatus')->will($this->returnValue('Complete'));
        $order->expects($this->any())->method('getId')->will($this->returnValue(12));

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