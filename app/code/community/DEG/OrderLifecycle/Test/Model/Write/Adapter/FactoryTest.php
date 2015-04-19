<?php


class DEG_OrderLifecycle_Tests_Model_Write_Adapter_FactoryTest extends EcomDev_PHPUnit_Test_Case {

    public function testGetWriteAdapter(){
        $factory = new DEG_OrderLifecycle_Model_Write_Adapter_Factory();
        $adapter = $factory->getWriteAdapter();
        $this->assertTrue($adapter instanceof DEG_OrderLifecycle_Model_Write_Adapter_Order_History);

    }

}