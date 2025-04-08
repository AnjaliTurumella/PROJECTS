from pymongo import MongoClient
import os
import datetime

def get_db():
    # MongoDB connection (local or Atlas)
    mongo_uri = os.getenv('MONGO_URI', 'mongodb://localhost:27017/')
    client = MongoClient(mongo_uri)
    db = client['LAF_db']
    return db

def init_db():
    db = get_db()
    # Create collections if they don't exist
    if 'items' not in db.list_collection_names():
        db.create_collection('items')
        # Create indexes for better search performance
        db.items.create_index([('name', 'text'), ('location', 'text')])