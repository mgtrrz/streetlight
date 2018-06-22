# -*- mode: ruby -*-
# vi: set ft=ruby :

vagrant_name = File.basename(Dir.pwd)

Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  config.vm.box = "bento/ubuntu-16.04"

  # Copying over our config files
  config.vm.provision "file", source: "./configs", destination: "$HOME/configs"

  # For allowing http traffic into the vm
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  config.vm.synced_folder "./www", "/var/www/local/", owner: "www-data", group: "www-data", create: "true"

  config.vm.provider "virtualbox" do |vb|
     vb.gui = false
  
     # Customize the amount of memory on the VM:
     vb.memory = "1024"
     vb.name = vagrant_name
  end

  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", path: "setup/setup.sh"
end
