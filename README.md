# Chat Application Admin Dashboard

A full-featured admin dashboard built with Laravel for managing 
a chat application's users, points system, and gifts economy.

## Overview

This dashboard gives administrators full control over the 
chat platform's core operations — from user management to 
a complete points-based gift marketplace.

## Features

- **User Management** — View, search, activate, 
  or ban users across the platform
- **Points System** — Configure and manage how users 
  earn and spend points
- **Gift Management** — Add, edit, and remove gifts 
  available in the platform store
- **Gift Store** — Users can redeem their points 
  to purchase gifts directly through the system

## Tech Stack

- **Backend:** Laravel, MySQL
- **Frontend:** Blade, JavaScript
- **Auth:** Role-Based Access Control (RBAC)

## Installation
```bash
git clone https://github.com/Bader533/[repo-name]
cd [repo-name]
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
