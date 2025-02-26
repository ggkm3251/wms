# Wardrobe Management System

A web application for managing your wardrobe, built with Vue 3 (frontend) and Laravel 11 (backend).

## Features
- User authentication (login/registration).
- Add, edit, and delete clothing items.
- Categorize items (e.g., tops, bottoms, shoes).
- Filter and search functionality.
- Responsive and user-friendly UI.

## Setup Instructions

### Backend (Laravel 11)
1. Clone the repository:
   ```
   git clone https://git@github.com:ggkm3251/wms.git
   cd wms/wardrobe-ms-app
   ```
2. Install dependencies:
   ```
   composer install
   ```
3. Set up the .env file:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations:
   ```
   php artisan migrate
   ```
5. Start the server:
   ```
   php artisan serve
   ```

### Frontend (Vue 3)
1. Navigate to the frontend directory:
   ```
   cd ../wardrobe-frontend
   ```
2. Install dependencies:
   ```
   npm install
   ```
3. Start the development server:
   ```
   npm run dev
   ```

### Live Demo