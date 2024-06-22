# compress photos of a folder 
import os
import zipfile
from PIL import Image

def compress_images(input_folder, output_folder, quality):
    if not os.path.exists(output_folder):
        os.makedirs(output_folder)

    # Initialize a counter for serial numbers
    i = 0

    # Loop through all files in the input folder
    for filename in os.listdir(input_folder):
        input_path = os.path.join(input_folder, filename)

        try:
            with Image.open(input_path) as img:
                # Construct the output path
                output_path = os.path.join(output_folder, filename)

                # Compress and save the image
                img.save(output_path, optimize=True, quality=quality)
                i += 1
                print(f"SN {i}: {filename} compressed and saved to {output_folder}")

        except IOError as e:
            print(f"Error processing {filename}: {e}")
        except Exception as e:
            print(f"An unexpected error occurred with {filename}: {e}")

def zip_folder(folder_path, output_path):
    # Create a ZipFile object
    with zipfile.ZipFile(output_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
        # Iterate over all the files in the directory
        for root, dirs, files in os.walk(folder_path):
            for file in files:
                # Create the complete file path
                file_path = os.path.join(root, file)
                # Add file to the zip file
                zipf.write(file_path, os.path.relpath(file_path, folder_path))

# Define input and output directories
input_folder = input('enter input folder name: ')
quality=int(input('enter compressed image quality % (0 - 100): '))
output_folder = input_folder+'_compressed'

# Compress images
compress_images(input_folder, output_folder, quality)
i=input('*****\nall files compressed from '+input_folder+' and saved to '+output_folder+', do you want to create zip of all files? yes/no: ')
if(i=='yes'):
    zip_folder(output_folder, input_folder+'_compressed.zip')
    input('zip file created, press enter to exit')


