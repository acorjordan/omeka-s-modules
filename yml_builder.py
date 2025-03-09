import requests
from bs4 import BeautifulSoup
import yaml

# URL of the Omeka S modules page
URL = "https://omeka.org/s/modules/"

# Fetch the page content
response = requests.get(URL)
soup = BeautifulSoup(response.text, 'html.parser')

modules = []

# Extract module data
div_entries = soup.find_all("div", class_="module addon-entry")
for entry in div_entries:
    title_tag = entry.find("h4")
    download_tag = entry.find("a", class_="button")
    version_tag = entry.find("span", class_="version")
    updated_tag = entry.find("span", class_="date")

    if title_tag and download_tag:
        title = title_tag.text.strip()
        link = download_tag["href"]
        version = version_tag.text.replace("Latest Version: ", "").strip() if version_tag else "Unknown"
        updated = updated_tag.text.replace("Updated: ", "").strip() if updated_tag else "Unknown"

        # Determine if the module should be downloaded
        download = "archived" not in title.lower()

        modules.append({
            "name": title,
            "link": link,
            "version": version,
            "updated": updated,
            "download": download
        })

# Save to YAML
with open("modules.yml", "w") as file:
    yaml.dump({"modules": modules}, file, default_flow_style=False, sort_keys=False)

print("YAML file 'modules.yml' generated successfully!")
