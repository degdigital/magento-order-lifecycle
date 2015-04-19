<?php
class DEG_OrderLifecycle_Test_Model_Lifecycle_Event_Api_EventTest extends EcomDev_PHPUnit_Test_Case
{

    public function testInitDataObject()
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

        $apiEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Api_Event();
        $apiEvent->initDataObject();

        $this->assertEquals(1,$apiEvent->getUserId());
        $this->assertEquals('username',$apiEvent->getUsername());
        $this->assertEquals('email',$apiEvent->getEmail());
    }

    public function testGetFormattedEventData()
    {
        $apiEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Api_Event();
        $apiEvent->setUsername('name');
        $formattedData = $apiEvent->getFormattedEventData();
        $this->assertEquals($formattedData, 'username: name<br>');
    }

}