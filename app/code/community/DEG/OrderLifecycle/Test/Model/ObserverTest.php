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
        $observerObject->setDataObject($order);

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
        $observerObject->setDataObject($invoice);

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
        $observerObject->setDataObject($payment);

        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->paymentSavedEventFlush($observerObject);
    }


    public function testLifecycleEventToRegistryNoCollection(){
        $user = new Mage_Admin_Model_User();

        $adminSessionMock = $this->getModelMockBuilder('admin/session')
            ->disableOriginalConstructor()
            ->setMethods(array('getUser'))
            ->getMock();
        $adminSessionMock->expects($this->any())->method('getUser')->will($this->returnValue($user));
        $this->replaceByMock('singleton', 'admin/session', $adminSessionMock);

        $adminSessionQuoteMock = $this->getModelMockBuilder('adminhtml/session_quote')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(null) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $this->replaceByMock('singleton', 'adminhtml/session_quote', $adminSessionQuoteMock);

        $event = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $observerObject = new Varien_Event_Observer();
        $observerObject->setDataObject($event);

        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        $this->assertNull($collection);
        $observer = new DEG_OrderLifecycle_Model_Observer();
        $observer->lifecycleEventToRegistry($observerObject);
        $collection = Mage::registry(DEG_OrderLifecycle_Model_Lifecycle_Event_Collection::REGISTRY_LIFECYCLE_EVENT_COLLECTION);
        $this->assertNotNull($collection);
    }

    public function testLifecycleEventToRegistryExistingCollection(){

        $user = new Mage_Admin_Model_User();

        $adminSessionMock = $this->getModelMockBuilder('admin/session')
            ->disableOriginalConstructor()
            ->setMethods(array('getUser'))
            ->getMock();
        $adminSessionMock->expects($this->any())->method('getUser')->will($this->returnValue($user));
        $this->replaceByMock('singleton', 'admin/session', $adminSessionMock);

        $adminSessionQuoteMock = $this->getModelMockBuilder('adminhtml/session_quote')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(null) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $this->replaceByMock('singleton', 'adminhtml/session_quote', $adminSessionQuoteMock);

        $event = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $observerObject = new Varien_Event_Observer();
        $observerObject->setDataObject($event);
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