# magento-order-lifecycle
Track everything and anything that is related to an order and write it so that it can be seen in the admin panel. Magento 1.X

# Setup Instructions on host
1. `mkdir -p /var/magento/hackathon`
2. `chmod -R 777 /var/magento`
3. `cd /var/magento`
4. `git clone https://github.com/degdigital/magento-order-lifecycle.git`
5. `cd /var/magento/magento-order-lifecycle`
6. `vagrant up`

# Setup Apache
1. cd /etc/httpd/conf.d
2. sudo vi 25-magentovhost.conf
3. Change DocumentRoot to /var/magento/hackathon
4. Change Document to /var/magento/hackathon
5. Change ServerName should be set to hackathon.dev
6. Restart Apache
7. Add hackathon.dev to your host machine's /etc/hosts file.

# Setup Magento on VM
1. `mysql -uroot`
2. `CREATE USER 'hackathon'@'localhost' IDENTIFIED BY 'password123';`
3. `GRANT ALL PRIVILEGES ON * . * TO 'hackathon'@'localhost';`
4. `GRANT ALL PRIVILEGES ON * . * TO 'hackathon'@'%';`
5. `quit`
6. `n98-magerun.phar install --magentoVersionByName=magento-ce-1.9.1.0 --installationFolder=/var/magento/hackathon --dbHost=localhost --dbUser=hackathon --dbPass=password123 --baseUrl=http://hackathon.dev/`

# Install module on host
1. composer.phar install
2. cd /var/magento/hackathon
3. bash < <(wget -q --no-check-certificate -O - https://raw.github.com/colinmollenhour/modman/master/modman-installer)
4. modman init
5. modman clone git://github.com/degdigital/magento-order-lifecycle.git
