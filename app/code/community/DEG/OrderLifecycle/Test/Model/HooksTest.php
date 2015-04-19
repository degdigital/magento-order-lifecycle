<?php


class DEG_OrderLifecycle_Tests_Model_HooksTest extends EcomDev_PHPUnit_Test_Case {

    public function testShippmentCreatedLifecyceEvent(){
        $expectedValue = new Varien_Object();
        $expectedValue->setMessage('Shippment Created');
        $observer = $this->mockModel('deg_orderlifecycle/hooks',array('_dispatchEvent'));
        $observer->expects($this->any())->method('_dispatchEvent')->with('lifecycle_event', $expectedValue);
        $observerObject = new Varien_Event_Observer();
        $observer->shippmentCreatedLifecyceEvent($observerObject);
    }

    public function testInvoiceCreatedLifecyceEvent(){
        $expectedValue = new Varien_Object();
        $expectedValue->setMessage('Invoice Created');
        $observer = $this->mockModel('deg_orderlifecycle/hooks',array('_dispatchEvent'));
        $observer->expects($this->any())->method('_dispatchEvent')->with('lifecycle_event', $expectedValue);
        $observerObject = new Varien_Event_Observer();
        $observer->invoiceCreatedLifecyceEvent($observerObject);
    }

    public function testPaymentRefundLifecyceEvent(){
        $expectedValue = new Varien_Object();
        $expectedValue->setMessage('Refunded Order');
        $observer = $this->mockModel('deg_orderlifecycle/hooks',array('_dispatchEvent'));
        $observer->expects($this->any())->method('_dispatchEvent')->with('lifecycle_event', $expectedValue);
        $observerObject = new Varien_Event_Observer();
        $observer->paymentRefundLifecyceEvent($observerObject);
    }

    public function testPaymentCapturedLifecyceEvent(){
        $expectedValue = new Varien_Object();
        $expectedValue->setMessage('Captured Payment');
        $observer = $this->mockModel('deg_orderlifecycle/hooks',array('_dispatchEvent'));
        $observer->expects($this->any())->method('_dispatchEvent')->with('lifecycle_event', $expectedValue);
        $observerObject = new Varien_Event_Observer();
        $observer->paymentCaptureLifecyceEvent($observerObject);
    }

    public function testOrderAfterSaveLifecycleEvent(){


        $order = $this->mockModel('sales/order', array('getData','getOrigData'));
        $order->expects($this->any())->method('getData')->will($this->returnValue('hold'));
        $order->expects($this->any())->method('getOrigData')->will($this->returnValue('new'));

        $expectedValue = new Varien_Object();
        $expectedValue->setOldStatus('new');
        $expectedValue->setNewStatus('hold');

        $observer = $this->mockModel('deg_orderlifecycle/hooks',array('_dispatchEvent'));
        $observer->expects($this->any())->method('_dispatchEvent')->with('lifecycle_event', $expectedValue);
        $observerObject = new Varien_Event_Observer();
        $observerObject->setDataObject($order);

        $observer->orderAfterSaveLifecycleEvent($observerObject);
    }
}