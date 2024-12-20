import os
import cv2
import numpy as np
import tensorflow as tf
from tensorflow.keras.applications import VGG16
from tensorflow.keras.applications.vgg16 import preprocess_input
from sklearn.metrics.pairwise import cosine_similarity
import mysql.connector
import sys
import json


# Ensure an argument is provided
if len(sys.argv) < 2:
    print("No argument provided")
    sys.exit(1)
uploaded_image_path = sys.argv[1]

# Pre-trained model for feature extraction
try:
    model = VGG16(weights='imagenet', include_top=False, pooling='avg')
except Exception as ex:
    print("model:"+str(ex))
def load_and_process_image(image_path, target_size=(224, 224)):
    
    img = cv2.imread(image_path)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    img = cv2.resize(img, target_size)
    img = preprocess_input(img)
    img = np.expand_dims(img, axis=0)
    return img

def extract_features(image_path):
    try:
        img = load_and_process_image(image_path)
        try:
            features = model.predict(img,verbose = 0)
        except Exception as e:
            print("exe predict: "+ str(e))
        return features.flatten()  # Ensure the feature vector is a 1D array
    except Exception as e:
        print("exe: "+ str(e))
        return None

def connect_db():
    connection = mysql.connector.connect(
        host='localhost',
        user='root',
        password='', 
        database='stage',
    )
    return connection

def save_image_features_to_db(image_path, features):
    conn = connect_db()
    cursor = conn.cursor()
    
    features_str = ",".join(str(f) for f in features)
    image_name = os.path.basename(image_path)
    
    query = "SELECT id FROM produit WHERE image_name = %s"
    cursor.execute(query, (image_name,))
    result = cursor.fetchone()
    
    if result:
        update_query = "UPDATE produit SET image_features = %s WHERE image_name = %s"
        cursor.execute(update_query, (features_str, image_name))
    else:
        insert_query = "INSERT INTO produit (image_name, image_features) VALUES (%s, %s)"
        cursor.execute(insert_query, (image_name, features_str))
        
    conn.commit()
    cursor.close()
    conn.close()

def compare_uploaded_image_with_db(uploaded_image_path,coef):
    #print("comp")
    uploaded_features = extract_features(uploaded_image_path)
    #print(uploaded_features)
    conn = connect_db()
    cursor = conn.cursor()
    
    query = "SELECT image_name, image_features FROM produit"
    cursor.execute(query)
    results = cursor.fetchall()
    
    similarities = []
    for image_name, features_str in results:
        if(features_str):
            #print(features_str)
            db_features = np.array([float(x) for x in features_str.split(",")])
            similarity = cosine_similarity([uploaded_features], [db_features])[0][0]
            #print(similarity)
            if(similarity>=coef):
                similarities.append((image_name, similarity))
    
    similarities.sort(key=lambda x: x[1], reverse=True)
    
    cursor.close()
    conn.close()
    
    return [image_name for image_name, similarity in similarities[:5]]

def process_uploaded_image(uploaded_image_path,coef):
    similar_images = compare_uploaded_image_with_db(uploaded_image_path,coef)
    return similar_images

if True:
    
    if sys.argv[2]=="upload":
        uploaded_image_path="image\\"+uploaded_image_path
        features=extract_features(uploaded_image_path)
        save_image_features_to_db(uploaded_image_path, features)
    else:
        uploaded_image_path="uploads\\"+uploaded_image_path
        #print("search "+ uploaded_image_path)
        similar_images = process_uploaded_image(uploaded_image_path,float(sys.argv[3]))
        for img in similar_images:
            print(img," ")
