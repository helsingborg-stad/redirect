#!/bin/bash

# install go

if ! command -v go &> /dev/null; then
    echo "Go not found, installing Go..."
    wget https://golang.org/dl/go1.22.3.linux-amd64.tar.gz
    sudo tar -C /usr/local -xzf go1.22.3.linux-amd64.tar.gz
    rm go1.22.3.linux-amd64.tar.gz
    echo 'export PATH=$PATH:/usr/local/go/bin' >> ~/.bashrc
    source ~/.bashrc
fi

# Install XCaddy

sudo apt install -y debian-keyring debian-archive-keyring apt-transport-https
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/xcaddy/gpg.key' | sudo gpg --dearmor -o /usr/share/keyrings/caddy-xcaddy-archive-keyring.gpg
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/xcaddy/debian.deb.txt' | sudo tee /etc/apt/sources.list.d/caddy-xcaddy.list
sudo apt update
sudo apt install xcaddy

# Build caddy with plugins

xcaddy build \
    --with github.com/caddy-dns/loopia \
    --with github.com/caddy-dns/namedotcom

mv ./caddy /usr/local/bin/

# Create folders

echo "Creating necessary directories..."
sudo mkdir -p /etc/caddy /var/log/caddy /srv

# Create a basic Caddyfile
echo "Creating a basic Caddyfile..."

cat <<-EOF >> "Caddyfile"
{
    # Global options block. Entirely optional, https is on by default
    # Optional email key for lets encrypt
    email you@example.com
    # Optional staging lets encrypt for testing. Comment out for production.
    acme_ca https://acme-staging-v02.api.letsencrypt.org/directory
}

# Define a site and how to respond to requests
example.com, www.example.com {
    root * /srv
    file_server
}
EOF

# Create the systemd service file
echo "Creating systemd service file..."
cat <<EOT | sudo tee /etc/systemd/system/caddy.service
[Unit]
Description=Caddy web server
Documentation=https://caddyserver.com/docs/
After=network.target

[Service]
User=root
Group=root
ExecStart=/usr/local/bin/caddy run --config /etc/caddy/Caddyfile
ExecReload=/usr/local/bin/caddy reload --config /etc/caddy/Caddyfile
Restart=on-failure
TimeoutStopSec=5s
LimitNOFILE=1048576
LimitNPROC=512
PrivateTmp=true
ProtectSystem=full
ReadWritePaths=/var/lib/caddy /var/log/caddy

[Install]
WantedBy=multi-user.target
EOT

# Reload systemd, enable and start the Caddy service
echo "Reloading systemd, enabling and starting Caddy service..."
sudo systemctl daemon-reload
sudo systemctl enable caddy
sudo systemctl start caddy

# Print the status of the Caddy service
echo "Checking the status of the Caddy service..."
sudo systemctl status caddy

echo "Caddy has been installed and started successfully."

exit 0