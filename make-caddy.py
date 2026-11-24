import json
import os

key_directory = "./domains"

class Domain:
    def __init__(self, filename: str, domain: str, path: str | bool, permanent: bool):
        self.filename = filename
        self.domain = domain
        self.path = path
        self.permanent = permanent
    
    @property
    def redirect(self) -> str:
        redirectType = "permanent" if self.permanent else "temporary"
        path = "{uri}" if self.path is True else "" if not self.path else self.path

        return f"redir https://{self.domain}{path} {redirectType}"

    def __repr__(self):
        return f"<Domain domain:{self.domain}, path:{self.path}, permanent:{self.permanent}>"

    def to_caddyblock(self) -> str:
        # Root domains receive the www alias. Certificates for redirect hosts
        # are obtained only when that hostname is first requested, rather than
        # trying every catalogue entry when Caddy starts.
        if self.filename.count(".") == 1:  # Root domain has only one dot (e.g., example.com)
            hosts = f"{self.filename}, www.{self.filename}"
        else:
            hosts = self.filename
        return f"{hosts} {{\n\ttls {{\n\t\ton_demand\n\t}}\n\t{self.redirect}\n}}\n\n"

def read_files() -> dict[str, Domain]:
    domainList = {}

    for filename in os.listdir(key_directory):
        if not filename.endswith(".json"):
            pass
        else:
            filePath = os.path.join(key_directory, filename)

            fileDomain = filename.replace(".json", "")

            with open(filePath, "r") as jsonFile:
                try:
                    data = json.load(jsonFile)
                    domain = data.get("domain", "")
                    path = data.get("path", True)
                    permanent = data.get("permanent", False)
                    domain = Domain(fileDomain, domain, path, permanent)

                    domainList[fileDomain] = domain

                except json.JSONDecodeError:
                    print(f"Invalid JSON in {filename}!")
                    pass
    
    return domainList
    

def build_caddyfile(domains: dict[str, Domain]) -> str:
    return "".join(domain.to_caddyblock() for _, domain in sorted(domains.items()))

if __name__ == "__main__":
    domainList = read_files()
    caddyOutput = build_caddyfile(domainList)

    with open('Caddyfile', 'w') as file:
        file.write(caddyOutput.rstrip() + "\n")
    
    print("All done :)")
