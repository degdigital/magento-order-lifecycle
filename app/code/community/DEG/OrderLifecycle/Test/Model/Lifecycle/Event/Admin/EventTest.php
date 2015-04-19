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

        $adminSessionQuoteMock = $this->getModelMockBuilder('adminhtml/session_quote')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(null) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $this->replaceByMock('singleton', 'adminhtml/session_quote', $adminSessionQuoteMock);

        $adminEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $adminEvent->initDataObject();

        $this->assertEquals(1,$adminEvent->getUserId());
        $this->assertEquals('username',$adminEvent->getUsername());
        $this->assertEquals('email',$adminEvent->getEmail());
    }

    public function testInitDataObjectReorder()
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

        $adminSessionQuoteMock = $this->getModelMockBuilder('adminhtml/session_quote')
            ->disableOriginalConstructor() // This one removes session_start and other methods usage
            ->setMethods(array('getReordered')) // Enables original methods usage, because by default it overrides all methods
            ->getMock();
        $adminSessionQuoteMock->expects($this->any())->method('getReordered')->will($this->returnValue('1234'));
        $this->replaceByMock('singleton', 'adminhtml/session_quote', $adminSessionQuoteMock);

        $adminEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event();
        $adminEvent->initDataObject();

        $this->assertEquals('1234',$adminEvent->getReorderPreviousOrderId());
    }

}