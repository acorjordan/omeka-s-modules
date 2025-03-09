#!/bin/bash
mkdir -p modules

echo "Reading modules.yml..."
modules=$(yq e '.modules[] | select(.download == true) | .link' modules.yml)

for url in $modules; do
    filename=$(basename "$url")
    echo "Downloading $filename..."
    wget -q "$url" -O "modules/$filename"
    echo "Extracting $filename..."
    unzip -q "modules/$filename" -d modules/
    rm "modules/$filename"
done

echo "All modules downloaded and extracted."