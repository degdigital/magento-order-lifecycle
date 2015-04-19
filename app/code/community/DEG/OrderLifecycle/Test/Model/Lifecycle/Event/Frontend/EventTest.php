<?php
class DEG_OrderLifecycle_Test_Model_Lifecycle_Event_Frontend_EventTest extends EcomDev_PHPUnit_Test_Case
{

    public function testInitDataObject()
    {
        $helper = $this->getHelperMock('core/http', array('getRemoteAddr'));
        $helper->expects($this->once())->method('getRemoteAddr')->will($this->returnValue('127.0.0.1'));
        $this->replaceByMock('helper', 'core/http', $helper);

        $frontendEvent = new DEG_OrderLifecycle_Model_Lifecycle_Event_Frontend_Event();
        $frontendEvent->initDataObject();

        $this->assertEquals('Frontend',$frontendEvent->getEventType());
        $this->assertEquals('127.0.0.1',$frontendEvent->getRemoteIp());
    }


}