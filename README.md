# CarePlus – Medical Support System

CarePlus is a Laravel-based medical assistance platform that enables users to browse medicines, explore departments, manage their cart, place orders, and submit reviews. The system includes a complete admin backend, image upload support, API endpoints, and a responsive frontend designed with Tailwind CSS and a custom styles.css file.

---

## Features

### Medicines Module
- Admin can add, edit, delete, and search medicines.  
- Each medicine includes: name, category, price, description, and image.  
- Image upload and storage handled by `MedicineService`.  
- AJAX-based search for instant filtering.  
- Detailed medicine page with reviews and quantity selector.  
- REST API for CRUD operations.  

### Departments Module
- Departments are fetched from the database dynamically.  
- Admin can create, update, and delete departments.  
- **Future Scope:** Doctor-module integration to enable appointments and bookings.  

### Cart & Checkout Module
- Users can add medicines to their cart.  
- Update or remove items dynamically.  
- Checkout form calculates totals and stores order details.  
- Thank-you screen after successful order placement.  

### Reviews Module
- Users can submit reviews for each medicine.  
- One-to-many relationship between medicine and reviews.  
- Displayed automatically on detail page.  

### Frontend Pages (User Side)
All pages are fully responsive and built with Tailwind CSS + custom styles:

- `medicines.blade.php` – List of all medicines with filters/search  
- `medicinedetail.blade.php` – Single product page with reviews  
- `dept.blade.php` – All departments  
- `cart.blade.php` – View/manage cart  
- `checkout.blade.php` – Final order form  
- `thankyou.blade.php` – Order confirmation  

---

## Project Setup Instructions

Follow these steps to run the project locally:

1. **Clone the Repository**  
```bash
git clone https://github.com/FatimaSaleem7/SCD_Theory_laravel.git
cd SCD_Theory_laravel

2. **Install PHP & Node Dependencies**
composer install
npm install

3. **Create Environment File**
cp .env.example .env

Update .env with your local database settings:
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

4. **Generate App Key**
php artisan key:generate

5. **Run Migrations**
php artisan migrate

6. **Link Storage for Image Uploads**
php artisan storage:link

7. **Start Development Server**
php artisan serve

---

## Usage guide
# For Users (Frontend)
-Visit /medicines to browse all medicines.
-Open /medicines/{id} for detailed view, reviews, and add-to-cart.
-Manage items in /cart.
-Finalize purchase at /checkout.
-View confirmation at /thankyou.
-Explore all departments at /dept.

# For Admin
Admin-side functionality includes:
-Adding/editing/deleting medicines
-Updating departments
-Handling medicine images via MedicineService
-Managing API-based CRUD operations

#API Endpoints (can be tested via Postman):
-GET    /api/medicines
-POST   /api/medicines
-GET    /api/medicines/{id}
-PUT    /api/medicines/{id}
-DELETE /api/medicines/{id}
