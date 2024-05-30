# HBG Redirect V2

A "simple" service that redirects.

## Adding a new redirect

In order to add a new redirect, create a new json file in the `domains` folder. The name should match the domain you're redirecting FROM, with dots.

Inside, use the following keys. The ones marked with ⭐ are mandatory.

-  ⭐ `domain` - The domain to redirect TO
- `path` - If the path should be kept with the redirect
- `permanent` - If the redirect should be a 301 status
- ⭐ `ssl` - Which path to take when generating the SSL certificate.

## SSL

In order to get working ssl certs, you need to specify the key `ssl` in your json.

Set it to one of the following:

- rsnv: For domains on the rsnv account
- hbg: For domains on the helsingborg account
- famhbg: For domains on the familjen helsingborg account
- hbgproxy: For domains needing to be certified with the proxy domain (Basically *.helsingborg.se)

## Generating the Caddyfile

Extremely simple once you've filled out your `.env` file!

```sh
chmod +x ./make-caddy.sh
./make-caddy.sh
```