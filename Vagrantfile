# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # All Vagrant configuration is done here. The most common configuration
  # options are documented and commented below. For a complete reference,
  # please see the online documentation at vagrantup.com.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "centos-6-5-x64-virtualbox-php54"
  config.vm.box_url = "https://s3.amazonaws.com/magento-hackathon/centos-6-5-x64-virtualbox-php54.box"
  config.vm.box_download_checksum_type = "md5"
  config.vm.box_download_checksum = "eb0bf40dad1b7976191505c7cd593070-22"

  config.vm.synced_folder "../hackathon", "/var/magento/hackathon/", type: "nfs"

  config.vm.network :private_network, ip: "192.168.33.15"

  config.vm.provider :virtualbox do |vb, override|
    vb.name = "magentohackathon"
    vb.customize ["modifyvm", :id, "--memory", "2048"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

end
