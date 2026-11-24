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

## DNS report

The **DNS check** GitHub Actions workflow runs on pull requests, pushes to `main`,
and manual dispatch. Its job summary lists each redirect hostname with its CNAME,
AAAA and A records. It includes the `www` aliases generated
for root-domain entries. A hostname passes when it has at least one CNAME, A, or
AAAA record; missing records and lookup errors fail the check. A CNAME without a
resolved address still passes the check. Compare the reported IPs with the service's
public IP to verify their destinations; the check does not enforce an expected IP.

Run it locally with `python3 scripts/check_dns.py` (requires `dig`).
