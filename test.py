import json

# Load the stats from the JSON file
with open('stats.json', 'r') as f:
    stats = json.load(f)

# Calculate the total number of slokas
total_slokas = sum(item[2] or 0 for item in stats)

# Print the total number of slokas
print(f"Total number of slokas: {total_slokas}")