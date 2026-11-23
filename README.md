# BandRoster

A web-based Band and Discography Management CRM built with **Laravel**, **MySQL**, and **Bootstrap 5**. Designed for talent agencies and record labels to manage artist rosters, discographies, press kits, and role-based access control.

## Core & Extra Features

* **Public Catalog:** Guests can browse the band roster, view album counts, inspect discographies, and listen to embedded audio/video previews.
* **Role-Based Access Control (RBAC):**
  * **Guests:** Read-only access to bands, albums, previews, and discography exports.
  * **Authenticated Users (`user_type = 0`):** Can edit existing bands and albums via a protected dashboard.
  * **Administrators (`user_type = 1`):** Full CRUD access (create, edit, and delete bands and albums) enforced on both UI (Blade directives) and backend routes (`CheckAdmin` middleware).
* **Safe Deletion Integrity:** Foreign key constraints prevent deleting a band while albums are still attached, paired with automatic storage cleanup when photos or covers are replaced or deleted.
* **Authentication & Password Recovery:** Powered by **Laravel Fortify** with SMTP password reset support (tested via Mailtrap).
* **Multi-Format Discography Export:** Export any band's profile and discography as a formatted **PDF Press Kit** (`barryvdh/laravel-dompdf`), **CSV**, or **JSON**.
* **Embedded Media Previews:** Automatically converts standard **Spotify** and **YouTube** album/track/playlist URLs into embedded mini-players.
* **Database Seeders:** Includes idempotent seeders (`firstOrCreate`) for default roles and a starter artist roster.

## Tech Stack

* **Backend:** PHP 8.x, Laravel, Laravel Fortify, DomPDF
* **Database:** MySQL
* **Frontend:** Blade Templates, Bootstrap 5, Custom CSS

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/WiCardos/BandRoster.git
   cd BandRoster
    ```
2. **Install PHP dependencies:**
   ```bash
   composer install
    ```
3. **Configure environment variables:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update the DB_* variables in .env with your local MySQL credentials (DB_DATABASE=band_roster), set FILESYSTEM_DISK=public, and configure MAIL_* credentials if testing password recovery.
4. **Enable PHP GD Extension (Required for PDF images):**
   Ensure extension=gd is uncommented in your php.ini file so DomPDF can render JPEG/PNG band logos and album covers.
5. **Run database migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
6. **Link public storage:**
   ```bash
   php artisan storage:link
   ```
7. **Start the local development server:**
   ```bash
   php artisan serve
   ```
## Default Seeded Accounts

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@bandroster.com` | `admin@bandroster.com` |
| **Standard User** | `user@bandroster.com` | `user@bandroster.com` |
