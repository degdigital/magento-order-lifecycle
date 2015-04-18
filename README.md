# magento-order-lifecycle
Track everything and anything that is related to an order and write it so that it can be seen in the admin panel. Magento 1.X

# Setup Instructions on host
1. `mkdir -p /var/magento/hackathon`
2. `chmod -R 777 /var/magento`
3. `cd /var/magento`
4. `git clone https://github.com/degdigital/magento-order-lifecycle.git`
5. `cd /var/magento/magento-order-lifecycle`
6. `vagrant up`

The document root, Document on the VM will need to be set to /var/magento/hackathon
The ServerName should be set to hackathon.dev
Restart Apache

Add hackathon.dev to your host machine's /etc/hosts file.
