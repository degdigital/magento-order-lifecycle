<?php
class DEG_OrderLifecycle_Test_Model_Lifecycle_Event_Admin_EventTest extends EcomDev_PHPUnit_Test_Case
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

        $adminSessionMock = $this->getModelMockBuilder('admin/session')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(array('getUser')) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $adminSessionMock->expects($this->any())->method('getUser')->will($this->returnValue($adminUser));
        $this->replaceByMock('singleton', 'admin/session', $adminSessionMock);

        $adminEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $adminEvent->initDataObject();

        $this->assertEquals(1,$adminEvent->getUserId());
        $this->assertEquals('username',$adminEvent->getUsername());
        $this->assertEquals('email',$adminEvent->getEmail());
    }

}