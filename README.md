# HBG Redirect V2

A "simple" service that redirects.

## Adding a new redirect

In order to add a new redirect, create a new json file in the `domains` folder. The name should match the domain you're redirecting FROM, with dots.

Please note that if your domain includes non-latin characters, such as `å`, `ä` or `ö`, you will need to convert them into punycode, which can be done with [punycoder](https://www.punycoder.com/).

Inside, use the following keys. The ones marked with ⭐ are mandatory.

-  ⭐ `domain` - The domain to redirect TO
- `path` - The string path to redirect to, or a boolean `true` if the path should be kept with the redirect
- `permanent` - If the redirect should be a 301 status

Every source hostname is explicit. A root-domain record such as `example.com.json`
also serves `www.example.com`; add a separate JSON file for every other hostname.
This is intentional: Caddy uses HTTP-01, so each name must resolve to this service
on TCP port 80.

## TLS

Before adding or deploying a redirect, point the domain's A/AAAA record at the
redirect service's public IP, ensure TCP ports 80 and 443 are reachable, and allow
the ACME issuer in CAA. Caddy obtains and renews each certificate with HTTP-01.

## Installing

Please ensure that your system has python3 and pip installed.

## Generating the Caddyfile

```sh
python ./make-caddy.py
```
