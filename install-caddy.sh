#!/bin/bash

# HTTP-01 uses stock Caddy; no custom DNS-provider modules are needed.
sudo apt update
sudo apt install -y caddy

# Create folders

echo "Creating necessary directories..."
sudo mkdir -p /etc/caddy /var/log/caddy /srv

if [ ! -f /etc/redirect.env ]; then
    echo "Create /etc/redirect.env with REDIRECT_BASE_DOMAIN before starting Caddy."
    exit 1
fi

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
EnvironmentFile=/etc/redirect.env
ExecStart=/usr/bin/caddy run --config /etc/caddy/Caddyfile
ExecReload=/usr/bin/caddy reload --config /etc/caddy/Caddyfile
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
