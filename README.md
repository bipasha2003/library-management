# Laravel Docker Setup Guide
This guide will walk you through setting up a Laravel application with **Docker**, **github** using **Apache**, **MySQL**, and **phpMyAdmin**.

---

## 📌 Prerequisites

- Install [**Docker**](https://desktop.docker.com/win/main/amd64/Docker%20Desktop%20Installer.exe?utm_source=docker&utm_medium=webreferral&utm_campaign=dd-smartbutton&utm_location=module&_gl=1*54sat0*_gcl_au*OTg3Njk0MDc1LjE3NDAwODA1MDE.*_ga*MTc3NDEzMDA5OS4xNzQwMDgwNTAy*_ga_XJWPQMJYHQ*MTc0MDA4MDUwMS4xLjEuMTc0MDA4MDUwNy41NC4wLjA.)
- **Clone Project**
    - clone project from github repository
        ```sh
        git clone https://github.com/bipasha2003/library-management.git
        ```
    - navigate to the project directory
        ```sh
        cd library-management
        ```
---

## 🛠️ 4. Build & Run Containers
Run the following command inside your Laravel project directory:

```sh
docker-compose up --build -d
```

Check if all containers are running:

```sh
docker ps
```

---

## 🛠️ 5. Install Laravel Dependencies
Run the following inside the Laravel container:

```sh
docker exec -it laravel_app bash
composer install
cp .env.example .env
php artisan key:generate
chmod -R 775 storage bootstrap/cache
php artisan migrate
exit
```

---

## 🛠️ 6. Set Correct Permissions
Run the following inside the Laravel container:

```sh
docker exec -it laravel_app bash
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
exit
```

---

## ✅ Access the Application
- **Laravel App:** [http://localhost:8000](http://localhost:8000)
- **phpMyAdmin:** [http://localhost:8080](http://localhost:8080)
  - **Server:** `db`
  - **Username:** `root`
  - **Password:** `root`

---

## 🔄 General Instructions for managing Containers

### Start Containers:
```sh
docker-compose up -d
```

### Stop Containers:
```sh
docker-compose down
```

### View Running Containers:
```sh
docker ps
```

### Restart Containers:
```sh
docker-compose restart
```

### Check Logs:
```sh
docker logs laravel_app
```

---

## 🎉 Done!
Your Laravel application is now running inside Docker with Apache, MySQL, and phpMyAdmin! 🚀
