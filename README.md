# HBG Redirect V2

A "simple" service that redirects.

## Adding a new redirect

In order to add a new redirect, create a new json file in the `domains` folder. The name should match the domain you're redirecting FROM, with dots.

Please note that if your domain includes non-latin characters, such as `å`, `ä` or `ö`, you will need to convert them into punycode, which can be done with [punycoder](https://www.punycoder.com/).

Inside, use the following keys. The ones marked with ⭐ are mandatory.

-  ⭐ `domain` - The domain to redirect TO
- `path` - The string path to redirect to, or a boolean `true` if the path should be kept with the redirect
- `permanent` - If the redirect should be a 301 status
- ⭐ `ssl` - Which path to take when generating the SSL certificate.

### Wildcards

You can also add a wildcard domain, by instead specifying the `wildcard` key, and setting it to true.

Doing so still requires the `ssl` key to be set.

## SSL

In order to get working ssl certs, you need to specify the key `ssl` in your json.

Set it to one of the following:

- rsnv: For domains on the rsnv account
- hbg: For domains on the helsingborg account
- famhbg: For domains on the familjen helsingborg account
- hbgproxy: For domains needing to be certified with the proxy domain (Basically *.helsingborg.se)
- ignore: For any domains where you don't need an cert to be specifically generated, i.e if you've made a wildcard domain.
- parent: If your domain should be attached to a wildcards cert. (Preferred over ignore.)

## Installing

Please ensure that your system has python3 and pip installed.

Once these are installed, you may run pip install -r requirements.txt

## Generating the Caddyfile

Extremely simple once you've filled out your `.env` file!

```sh
python ./make-caddy.py
```
