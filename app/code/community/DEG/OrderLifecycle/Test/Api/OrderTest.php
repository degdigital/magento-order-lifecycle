<?php


class DEG_OrderLifecycle_Tests_Api_OrderTest extends EcomDev_PHPUnit_Test_Case {

    protected function _prepare(){

        $client = new SoapClient("http://hackathon.dev/api/soap/?wsdl"); //soap handle
        $apiuser= "soapuser"; //webservice user login
        $apikey = "magentoimagine"; //webservice user pass
        try {
            $sess_id= $client->login($apiuser, $apikey); //we do login
        } catch (Exception $e) { //while an error has occured
            echo "==> Error: " . $e->getMessage(); //we print this
        }
        return $sess_id;
    }

    public function testHold(){
        $session = $this->_prepare();
        $client = new SoapClient("http://hackathon.dev/api/soap/?wsdl"); //soap handle
        try {
            print_r($client->call($session, 'sales_order.hold', '100000094'));
        } catch (Exception $e) { //while an error has occured
            echo "==> Error: " . $e->getMessage(); //we print this
        }

    }

     public function testUnHold(){
        $session = $this->_prepare();
        $client = new SoapClient("http://hackathon.dev/api/soap/?wsdl"); //soap handle
        try {
            print_r($client->call($session, 'sales_order.unhold', '100000094'));
        } catch (Exception $e) { //while an error has occured
            echo "==> Error: " . $e->getMessage(); //we print this
        }

    }
}