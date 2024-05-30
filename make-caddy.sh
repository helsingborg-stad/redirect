#!/bin/bash

key_directory=./domains
include_directory=./include

check_reqs() {
    if ! command -v jq &> /dev/null; then
        echo "jq is not installed. Please install it before running this script."
        exit 1
    fi

    if [ ! -e ".env" ]; then
        echo ".env File does not exist. Please create it."
        exit 1
    fi
}

# Function to resolve environment variable references
resolve_env_vars() {
    local line="$1"
    local regex='\$([_a-zA-Z][_a-zA-Z0-9]*)'

    # Loop through matches of the regex pattern in the line
    while [[ $line =~ $regex ]]; do
        # Get the matched environment variable name
        var_name="${BASH_REMATCH[1]}"
        # Get the value of the environment variable
        var_value="${!var_name}"
        # Replace the reference with the value
        line="${line/${BASH_REMATCH[0]}/$var_value}"
    done

    echo "$line"
}

prepare_caddyfile() {
    if [[ -f "Caddyfile" ]]; then
        rm Caddyfile
    fi

    touch Caddyfile

    for file in "$include_directory"/*; do
             while IFS= read -r line || [ -n "$line" ]; do
                # Resolve environment variable references in the line
                updated_line=$(resolve_env_vars "$line")
                echo "$updated_line" >> Caddyfile
            done < "$file"
    done
}

read_files() {
    for file in "$key_directory"/*.json; do
        # Check if the file exists
        if [[ -f "$file" ]]; then
            # Extract the filename without the extension
            filename=$(basename "$file" .json)

            domain=$(jq -r '.domain' "$file")
            path=$(jq -r '.path' "$file")
            permanent=$(jq -r '.permanent' "$file")
            ssl_provider=$(jq -r '.ssl' "$file")

            if [[ "$permanent" == "true" ]]; then
                redirect_type="permanent"
            else
                redirect_type="temporary"
            fi

            if [[ "$provider" == "rsnv" ]]; then
                provider_line="import tls-rsnv"
            elif [[ "$provider" == "hbg" ]]; then
                provider_line="import tls-hbg"
            elif [[ "$provider" == "famhbg" ]]; then
                provider_line="import tls-famhbg"
            elif [[ "$provider" == "hbgproxy" ]]; then
                provider_line="import tls-hbgproxy"
            elif [[ "$provider" == "" ]]; then
                echo "Warning! SSL provider for $filename not set."
            fi

            cat <<-EOF >> "Caddyfile"
$filename {
    redir {
        to https://$domain$path $redirect_type
    }
}
EOF
        fi
    done

    echo "All done :)"
}

check_reqs

source .env

prepare_caddyfile
read_files