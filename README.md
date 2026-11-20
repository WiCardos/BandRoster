# BandRoster

A web-based Band and Discography Management CRM built with **Laravel**, **MySQL**, and **Bootstrap**. Designed for talent agencies and record labels to manage artist rosters, albums, and role-based access control.

## Features
* **Public Catalog:** Guests can browse the band roster, view album counts, and inspect each band's discography.
* **Role-Based Access Control (RBAC):**
  * **Guests:** Read-only access to bands and albums.
  * **Authenticated Users (`user_type = 0`):** Can edit existing bands and albums via a protected dashboard.
  * **Administrators (`user_type = 1`):** Full CRUD access (create, edit, and delete bands and albums).
* **Media Management:** Image upload and automatic storage cleanup for band photos and album covers.

## Tech Stack
* **Backend:** PHP 8.x, Laravel
* **Database:** MySQL
* **Frontend:** Blade Templates, Bootstrap 5
* **Authentication:** Laravel Fortify

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/](https://github.com/)WiCardos/BandRoster.git
   cd BandRoster
2. **Install PHP dependencies:**
    ```bash
   composer install
3. **Configure environment variables:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update the DB_* fields in .env with your local MySQL credentials (DB_DATABASE=band_roster) and set FILESYSTEM_DISK=public.
4. **Run database migrations:**
   ```bash
   php artisan migrate
5. **Link public storage (required for band/album images):**
   ```bash
   php artisan storage:link
6. **Start the local development server:**
   ```bash
   php artisan serve
