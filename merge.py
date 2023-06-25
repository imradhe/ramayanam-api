import os
import json

def merge_json_files(directory, output_file):
    merged_data = []

    # Iterate over each file in the directory
    for filename in os.listdir(directory):
        if filename.endswith('.json'):
            file_path = os.path.join(directory, filename)

            # Open the file and load the JSON data
            with open(file_path, 'r', encoding='utf-8') as file:
                json_data = json.load(file)

            # Extend the merged_data list with the data from the current file
            merged_data.extend(json_data)

    # Sort the merged data based on the "id" key
    sorted_data = sorted(merged_data, key=lambda x: [int(i) for i in x['id'].split('.')])

    # Write the sorted data to the output file
    with open(output_file, 'w', encoding='utf-8') as file:
        json.dump(sorted_data, file, ensure_ascii=False, indent=4)

    print(f"All JSON files merged and sorted into {output_file}.")

# Provide the directory containing the JSON files
directory = 'test'

# Provide the output file path
output_file = 'test/slokas.json'

# Call the function to merge and sort the JSON files
merge_json_files(directory, output_file)
