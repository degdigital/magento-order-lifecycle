<?php

class DEG_OrderLifecycle_Model_Lifecycle_Event_Admin_Event extends DEG_OrderLifecycle_Model_Lifecycle_Event {

    //Data: admin_user user_id, email, firstname, lastname
    protected function _initData()
    {
        /** @var Mage_Admin_Model_User $admin */
        $admin = Mage::getSingleton('admin/session')->getUser();
        $this->setUserId($admin->getId());
        $this->setUsername($admin->getUsername());
        $this->setEmail($admin->getEmail());
        $this->setFirstname($admin->getFirstname());
        $this->setLastname($admin->getLastname());
    }

    public function getFormattedEventData()
    {
        // TODO: Implement format() method.
        $formattedEventData = 'Admin User Id: '.$this->getUserId() . '<br>' .
            ' Admin User Name: '.$this->getUsername() . '<br>' .
            ' Admin Email: '.$this->getEmail() . '<br>' .
            ' Admin First Name: '.$this->getFirstname() . '<br>' .
            ' Admin Last Name: '.$this->getLastname() . '<br>';

        return $formattedEventData;
    }

}