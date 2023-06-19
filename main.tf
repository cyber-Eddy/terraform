terraform {
  required_providers {
    digitalocean = {
      source = "digitalocean/digitalocean"
      version = "2.28.1"
    }
  }
}

provider "digitalocean" {
  token = file("./digitalocean_token.txt")
}

resource "digitalocean_droplet" "example" {
  image    = "ubuntu-20-04-x64"
  name     = "terraform-project"
  region   = "nyc3"
  size     = "s-1vcpu-1gb"
  ssh_keys = [file("./SSHKey.txt")]


  user_data = <<-EOF
    #cloud-config
    runcmd:
      - set -o errexit
      - sudo apt-get update -y
      - sudo apt-get install git -y
      - sudo apt-get install docker.io -y
      - sudo systemctl start docker
      - sudo usermod -aG docker root
      - sudo curl -L https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose
      - sudo chmod +x /usr/local/bin/docker-compose
      - git clone https://github.com/cyber-Eddy/terraform.git /home/root/terraform
      - cd /home/root/terraform/Web_page
      - sudo chmod 666 /var/run/docker.sock
      - docker-compose up -d
      - echo "Ha finalizado"
  EOF
  
}

