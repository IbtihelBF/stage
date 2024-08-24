import os
import cv2
import numpy as np
from tensorflow.keras.applications import VGG16
from tensorflow.keras.applications.vgg16 import preprocess_input
from sklearn.metrics.pairwise import cosine_similarity
import matplotlib.pyplotas as plt

# pre-traned Model for d=features extraction
model = VVG16(weights='imagenet', include_top=False, pooling='avg')

def load_and_process_image(image_path, target_size=(224, 224)):
    # Load the image using OpenCV
    img = cv2.imread(image_path)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    img = cv2.resize(img, target_size)
    # image for the model
    img = preprocess_input(img)
    img = np.expand_dims(img, axis=0) # add dimension
    return img

def extract_features(image_path):
    img = load_and_process_image(image_path)
    features = model.predict(img)
    return features

def calculate_similarity(features,database_features):
    # calculate cosine similarity between features and database features
    similarity = cosine_similarity(features, database_features)
    return similarity

def find_most_smilar_images(query_image_path, database_images_path, top_n=5):
    # extract features of the query image
    query_features = extract_features(query_image_path)
    # extract features of the database images
    database_features = []
    for image_path in database_images_path:
        features = extract_features(image_path)
        database_features.append(features)
    # stack database features into a single numpy array
    database_features = np.stack(database_features)
    # calculate similarities
    similarities = calculate_similarity(query_features, database_features)
    # get indices of top N most similar images
    top_indices = np.argsort(similarities.flatten())[::-1][:top_n]
    # return similar images paths
    similar_images = [database_images_path[i] for i in top_indices]
    return similar_images
# exp usage
database_image_folder = 'C:\xampp\htdocs\stage\image'
database_images_path = [os.path.join(database_image_folder, fname)for fname in os.listdir(database_image_folder)]

query_image_path = 'C:\xampp\htdocs\stage\image\cit1.jpeg'
similar_images = find_most_smilar_images(query_image_path, database_images_path)

#display
plt.figure(figsize=(12, 7))
for i, img_path in enumerate(similar_images):
    img = cv2.imread(img_path)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    plt.suplot(1, len(similar_images), i+1)
    plt.imshow(img)
    plt.title("Similar Image {i+1}")
    plt.axis('off')
    plt.show