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
        $adminUser = new Varien_Object();
        $adminUser->setId(1);
        $adminUser->setUsername('username');
        $adminUser->setEmail('email');
        $adminUser->setFirstname('firstname');
        $adminUser->setLastname('lastname');

        $adminSessionMock = $this->getModelMockBuilder('admin/session')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(array('getUser')) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $adminSessionMock->expects($this->any())->method('getUser')->will($this->returnValue($adminUser));
        $this->replaceByMock('singleton', 'admin/session', $adminSessionMock);

        $factory = new DEG_OrderLifecycle_Model_Lifecycle_Event_Factory();
        $eventObject = $factory->getEventDataObject();
        $this->assertInstanceOf('DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event',$eventObject);
    }

    public function testGetEventDataObjectApi()
    {
        $this->setCurrentStore(0);
        $adminUser = new Varien_Object();
        $adminUser->setUserId(1);
        $adminUser->setUsername('username');
        $adminUser->setEmail('email');
        $adminUser->setFirstname('firstname');
        $adminUser->setLastname('lastname');

        $apiSessionMock = $this->getModelMockBuilder('api/session')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(array('getUser')) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $apiSessionMock->expects($this->any())->method('getUser')->will($this->returnValue($adminUser));
        $this->replaceByMock('singleton', 'api/session', $apiSessionMock);

        $apiServerMock = $this->getModelMock('api/server', array('getAdapter'));
        $apiServerMock->expects($this->any())->method('getAdapter')->will($this->returnValue('api'));
        $this->replaceByMock('singleton', 'api/server', $apiServerMock);


        $factory = new DEG_OrderLifecycle_Model_Lifecycle_Event_Factory();
        $eventObject = $factory->getEventDataObject();
        $this->assertInstanceOf('DEG_OrderLifecycle_Model_Lifecycle_Event_Api_Event',$eventObject);
    }

}