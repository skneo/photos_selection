import os
import shutil
import json

def copy_images(json_file, source_folder, destination_folder):
    # Load JSON array of image names
    with open(json_file, 'r') as f:
        image_names = json.load(f)

    # Create destination folder if it doesn't exist
    if not os.path.exists(destination_folder):
        os.makedirs(destination_folder)

    # Copy each image from source to destination
    i=0
    for image_name in image_names:
        i=i+1
        source_path = os.path.join(source_folder, image_name)
        destination_path = os.path.join(destination_folder, image_name)
        
        if os.path.exists(source_path):
            shutil.copy(source_path, destination_path)
            print(f"SN {i} Copied {image_name} to {destination_folder}")
        else:
            print(f"Image {image_name} not found in source folder")

# Example usage
json_file = input('enter json file name: ')
json_file=json_file+'.json'
source_folder = os.getcwd()
destination_folder = 'selected_photos'
copy_images(json_file, source_folder, destination_folder)
input('*****\nall files copied, press enter to exit')
