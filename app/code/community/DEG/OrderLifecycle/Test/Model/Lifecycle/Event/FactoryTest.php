<?php
class DEG_OrderLifecycle_Test_Model_Lifecycle_Event_FactoryTest extends EcomDev_PHPUnit_Test_Case
{

    public function testGetEventDataObjectFrontend()
    {
        $this->setCurrentStore(1);
        $factory = new DEG_OrderLifecycle_Model_Lifecycle_Event_Factory();
        $eventObject = $factory->getEventDataObject();
        $this->assertInstanceOf('DEG_OrderLifecycle_Model_Lifecycle_Event_Frontend_Event',$eventObject);
    }

    public function testGetEventDataObjectAdmin()
    {
        $this->setCurrentStore(0);
        $factory = new DEG_OrderLifecycle_Model_Lifecycle_Event_Factory();
        $eventObject = $factory->getEventDataObject();
        $this->assertInstanceOf('DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event',$eventObject);
    }

    public function testGetEventDataObjectApi()
    {
        $apiServerMock = $this->getModelMock('api/server', array('getAdapter'));
        $apiServerMock->expects($this->any())->method('getAdapter')->will($this->returnValue('api'));
        $this->replaceByMock('singleton', 'api/server', $apiServerMock);


        $factory = new DEG_OrderLifecycle_Model_Lifecycle_Event_Factory();
        $eventObject = $factory->getEventDataObject();
        $this->assertInstanceOf('DEG_OrderLifecycle_Model_Lifecycle_Event_Api_Event',$eventObject);
    }

}