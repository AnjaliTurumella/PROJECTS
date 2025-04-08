from flask import Flask, render_template, request, redirect, url_for, flash
from db import get_db, init_db
from pymongo import DESCENDING
import os
import datetime

app = Flask(__name__)
app.secret_key = os.getenv('SECRET_KEY', 'dev-secret-key')

# Initialize database
init_db()

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/view')
def view_items():
    search = request.args.get('search', '')
    db = get_db()
    
    query = {}
    if search:
        query = {
            '$or': [
                {'name': {'$regex': search, '$options': 'i'}},
                {'location': {'$regex': search, '$options': 'i'}},
                {'description': {'$regex': search, '$options': 'i'}}
            ]
        }
    
    items = list(db.items.find(query).sort('created_at', DESCENDING))
    return render_template('view.html', items=items, search=search)

@app.route('/report', methods=['GET', 'POST'])
def report_item():
    if request.method == 'POST':
        item_data = {
            'status': request.form['item-type'],
            'name': request.form['item-name'],
            'category': request.form['category'],
            'location': request.form['location'],
            'description': request.form['description'],
            'contact': request.form['phone'],
            'created_at': datetime.datetime.now()
        }
        
        # Handle image URL
        image_url = request.form.get('image-url', '').strip()
        if image_url:
            item_data['image'] = image_url
        
        db = get_db()
        db.items.insert_one(item_data)
        
        flash('Item reported successfully!', 'success')
        return redirect(url_for('view_items'))
    
    return render_template('report-item.html')

if __name__ == '__main__':
    app.run(debug=True)