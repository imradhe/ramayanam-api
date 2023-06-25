import requests
from bs4 import BeautifulSoup
import json
from tqdm import tqdm

def getCount(kanda, sarga):
    url = f"https://www.valmiki.iitk.ac.in/sloka?field_kanda_tid={kanda}&language=dv&field_sarga_value={sarga}"

    # Send a GET request to the URL
    response = requests.get(url)

    # Extract the HTML content from the response
    html = response.content

    # Create a BeautifulSoup object to parse the HTML
    soup = BeautifulSoup(html, 'html.parser')

    # Find all text within the HTML document
    text = soup.get_text()

    # Search for numbers in the format "1.2.20" and extract the last part
    import re
    pattern = r"\b\d+\.\d+\.\d+\b"
    numbers = re.findall(pattern, text)
    if numbers:
        numbers = [num.split('.') for num in numbers]
        numbers = [[int(part) for part in num] for num in numbers]
        numbers.sort(reverse=True)
        largest_number = numbers[0][2]
    else:
        largest_number = None

    return largest_number

# Define the list of kandas and their respective sargas
kandas = [
    {"name": "balakanda", "id": 1, "sargas": 77},
    {"name": "ayodhyakanda", "id": 2, "sargas": 119},
    {"name": "aranyakanda", "id": 3, "sargas": 75},
    {"name": "kishkindakanda", "id": 4, "sargas": 67},
    {"name": "sundarakanda", "id": 5, "sargas": 68},
    {"name": "yuddhakanda", "id": 6, "sargas": 131}
]

stats = {}

# Iterate over each kanda and sarga
for kanda in kandas:
    kanda_id = kanda["id"]
    sargas = kanda["sargas"]
    kanda_stats = []

    for sarga in tqdm(range(1, sargas + 1), desc=kanda["name"]):
        sloka_count = getCount(kanda_id, sarga)
        kanda_stats.append({sarga: sloka_count})

    stats[kanda_id] = kanda_stats

# Save the stats as JSON
with open('test.json', 'w') as f:
    json.dump(stats, f)

print("Stats saved as stats.json")
