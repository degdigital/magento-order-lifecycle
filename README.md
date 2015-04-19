# magento-order-lifecycle
Track everything and anything that is related to an order and write it so that it can be seen in the admin panel. Magento 1.X

# Features
This module contains a set of observers to create an lifecycle events. Refer to this [wiki page](https://github.com/degdigital/magento-order-lifecycle/wiki/Hook-List) for a list of the hooks. 

You can add your own events. Refer to this [wiki page](https://github.com/degdigital/magento-order-lifecycle/wiki/Adding-a-New-Event) 

You can add your own write adapters. Write adapters are used to write or send the event data. Refer to this [wiki page](https://github.com/degdigital/magento-order-lifecycle/wiki/Lifecycle-Write-Adapters) for the existing write adapters.

# ToDo
* Create a new view in the admin panel for the lifecycle events. 
* Add more hooks

# Configuration
* System > Configuration > Sales > Order Lifecycle - Defines the event writing adapter.
