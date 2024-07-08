from dotenv import load_dotenv
import os
import json
import re

load_dotenv()

key_directory = "./domains"
include_directory = "./include"

class Domain:
    def __init__(self, filename: str, domain: str, path: str | bool, permanent: bool, sslProvider: str, wildcard: bool):
        self.filename = filename
        self.domain = domain
        self.path = path
        self.permanent = permanent
        self._sslProvider = sslProvider
        self.wildcard = wildcard
        self.subdomains = []

    @property
    def sslProvider(self) -> str:
        if self._sslProvider == "":
            print(f"Warning! SSL provider for {self.filename} not set.")

        match self._sslProvider:
            case "rsnv":
                return "import tls-rsnv"
            case "hbg":
                return "import tls-hbg"
            case "famhbg":
                return "import tls-famhbg"
            case "hbgproxy":
                return "import tls-hbgproxy"
            case "ignore":
                return ""
            
    @property
    def redirect(self) -> str:
        redirectType = "permanent" if self.permanent else "temporary"
        path = "{uri}" if self.path == True else self.path

        return f"redir https://{self.domain}{path} {redirectType}"

    def add_subdomain(self, domain):
        self.subdomains.append(domain)

    def __repr__(self):
        return f"<Domain domain:{self.domain}, path:{self.path}, permanent:{self.permanent}, sslProvider:{self.sslProvider}, wildcard:{self.wildcard}, subdomains: {len(self.subdomains)}>"


    def __to_subdomain_block(self) -> str:
        subName = self.filename.split(".")[0]

        retStr =  f"    @{subName} host {self.filename}\n"
        retStr += f"    handle @{subName} {{\n"
        retStr += f"        {self.redirect}\n"
        retStr +=  "    }\n"

        return retStr

    def __to_wildcard_block(self) -> str:
        retStr = ""

        if not self.wildcard:
            raise Exception("Tried to make wildcard block on non-wildcard domain!")

        retStr += f"{self.filename} {{\n"
        retStr += f"    {self.sslProvider}\n"

        if len(self.subdomains) > 0:
            for sub in self.subdomains:
                retStr += sub.__to_subdomain_block()

        retStr += "}"

        return retStr

    def to_caddyblock(self) -> str:
        if self.wildcard: return self.__to_wildcard_block()
        return f"""
            {self.filename} {{
                {self.sslProvider}

                {self.redirect}
            }}
        """

def resolve_env_vars(line):
    import re

    # Regex to find environment variable references like $VAR
    regex = r'\$([_a-zA-Z][_a-zA-Z0-9]*)'

    def replace_var(match):
        var_name = match.group(1)
        var_value = os.getenv(var_name, "")
        return var_value

    return re.sub(regex, replace_var, line)

def prepare_caddyfile():
    if os.path.exists("Caddyfile"):
        os.remove("Caddyfile")

    with open("Caddyfile", "w") as caddyfile:
        for filename in os.listdir(include_directory):
            with open(os.path.join(include_directory, filename), "r") as file:
                for line in file:
                    updated_line = resolve_env_vars(line)
                    caddyfile.write(updated_line)

            caddyfile.write("\n")

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
                    sslProvider = data.get("ssl", "")
                    wildcard = data.get("wildcard", False)

                    domain = Domain(fileDomain, domain, path, permanent, sslProvider, wildcard)

                    domainList[fileDomain] = domain

                except json.JSONDecodeError:
                    print(f"Invalid JSON in {filename}!")
                    pass
    
    return domainList
    

def build_list(list: dict[str, Domain]):
    newList = {}
    copiedList = dict(list)

    for filename, value in list.items():
        if value.wildcard:
            del copiedList[filename]
            newList[filename] = value

    for filename, value in newList.items():
        parentDomain = filename.replace("*.", "")
        matchDomain = rf".*\.{re.escape(parentDomain)}"

        for filename2 in dict(copiedList):
            if not re.match(matchDomain, filename2):
                pass
            else:
                newList[filename].add_subdomain(copiedList[filename2])
                del copiedList[filename2]

    for filename, value in copiedList.items():
        newList[filename] = value

    return newList


def build_caddyfile(domains: dict[str, Domain]) -> str:
    caddyOutput = ""

    for name, domain in domains.items():
        caddyOutput += domain.to_caddyblock()

    return caddyOutput

if __name__ == "__main__":
    load_dotenv()

    prepare_caddyfile()
    domainList = read_files()

    newList = build_list(domainList)

    caddyOutput = build_caddyfile(newList)

    with open('Caddyfile', 'a') as file:
        file.write(caddyOutput)
    
    print("All done :)")