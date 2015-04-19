<?php


class DEG_OrderLifecycle_Tests_Model_ObserverTest extends EcomDev_PHPUnit_Test_Case {

    public function testOrderSavedEventFlush(){
        $order = Mage::getModel('sales/order');

        $history = $this->mockModel('deg_orderlifecycle/write_adapter_order_history', array('flush'));
        $history->expects($this->once())->method('flush')->with($this->equalTo($order));

        $factory = $this->mockModel('deg_orderlifecycle/write_adapter_factory', array('getWriteAdapter'));
        $factory->expects($this->once())->method('getWriteAdapter')->will($this->returnValue($history));
        $this->replaceByMock('model', 'deg_orderlifecycle/write_adapter_factory', $factory);

        $observerObject = new Varien_Event_Observer();
        $observerObject->setObject($order);

        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->orderSavedEventFlush($observerObject);


    }

    public function testInvoiceSavedEventFlush(){
        $order = Mage::getModel('sales/order');
        $invoice = Mage::getModel('sales/order_invoice');
        $invoice->setOrder($order);
        $history = $this->mockModel('deg_orderlifecycle/write_adapter_order_history', array('flush'));
        $history->expects($this->once())->method('flush')->with($this->equalTo($order));

        $factory = $this->mockModel('deg_orderlifecycle/write_adapter_factory', array('getWriteAdapter'));
        $factory->expects($this->once())->method('getWriteAdapter')->will($this->returnValue($history));
        $this->replaceByMock('model', 'deg_orderlifecycle/write_adapter_factory', $factory);

        $observerObject = new Varien_Event_Observer();
        $observerObject->setObject($invoice);

        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->invoiceSavedEventFlush($observerObject);


    }


    public function testPaymentSavedEventFlush(){
        $order = Mage::getModel('sales/order');
        $payment = Mage::getModel('sales/order_payment');
        $payment->setOrder($order);
        $history = $this->mockModel('deg_orderlifecycle/write_adapter_order_history', array('flush'));
        $history->expects($this->once())->method('flush')->with($this->equalTo($order));

        $factory = $this->mockModel('deg_orderlifecycle/write_adapter_factory', array('getWriteAdapter'));
        $factory->expects($this->once())->method('getWriteAdapter')->will($this->returnValue($history));
        $this->replaceByMock('model', 'deg_orderlifecycle/write_adapter_factory', $factory);

        $observerObject = new Varien_Event_Observer();
        $observerObject->setObject($payment);

        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->paymentSavedEventFlush($observerObject);
    }


    public function testLifecycleEventToRegistryNoCollection(){
        $event = new Varien_Object();
        $observerObject = new Varien_Event_Observer();
        $observerObject->setEventData($event);

        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        $this->assertNull($collection);
        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->lifecycleEventToRegistry($observerObject);
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        $this->assertNotNull($collection);
    }

    public function testLifecycleEventToRegistryExistingCollection(){
        $event = new Varien_Object();
        $observerObject = new Varien_Event_Observer();
        $observerObject->setEventData($event);
        $collection = new DEG_OrderLifecycle_Model_Lifecycle_Event_Collection();
        $collection->addEvent($event);
        Mage::register(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION, $collection);
        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->lifecycleEventToRegistry($observerObject);
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        $this->assertEquals(2, sizeof($collection->getEvents()));
    }

    public function tearDown(){
        Mage::unregister(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
    }

}