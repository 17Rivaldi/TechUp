## About TechUp

TechUp adalah portal berita berbasis website yang dikembangkan menggunakan framework PHP, Laravel versi 11. Portal ini dirancang untuk menyajikan informasi terkini dalam dunia teknologi.

## Features

-   **Publikasi Artikel**: Artikel yang telah dibuat akan ditampilkan di portal berita setelah dipublikasikan.
-   **Manajemen Kategori**: Artikel dapat dikelompokkan berdasarkan kategori yang telah ditentukan.
-   **Manajemen Tag**: Artikel dapat diberikan lebih dari satu tag untuk memudahkan pengelompokan.
-   **Rekomendasi Editor**: Fitur yang memungkinkan editor untuk menandai artikel sebagai rekomendasi.
-   **Pencarian Artikel**: Pengguna dapat mencari artikel menggunakan kata kunci tertentu melalui fitur pencarian.
-   **Statistik Artikel Populer**: Menampilkan artikel berdasarkan jumlah pembaca terbanyak.
-   **Verifikasi Email**: Pengguna yang sudah berhasil melakukan registrasi diwajibkan untuk memverifikasi alamat email mereka.
-   **Ajukan Sebagai Penulis**: pengguna yang sudah terdaftar dapat mengajukan diri untuk menjadi penulis artikel melalui halaman profil.
-   **Manajemen User**: Admin dapat mengelola pengguna yang telah terdaftar untuk mengubahnya menjadi penulis atau editor.
-   **Manajemen Role**: Admin dapat membuat, mengedit, dan menghapus role sesuai dengan kebutuhan.

## Installation

Download/Clone this project

```bash
 git clone https://github.com/17Rivaldi/TechUp.git
```

Open directory

```bash
 cd TechUp
```

Run this command in terminal

```bash
 composer install
```

```bash
 cp .env.example .env
```

```bash
 php artisan key:generate
```

```bash
 php artisan migrate:fresh
```

```bash
 php artisan db:seed
```

```bash
 php artisan storage:link
```

## Setting file .env

```bash
 APP_NAME=TechUp
 APP_TIMEZONE=Asia/Jakarta

 APP_LOCALE=id
 APP_FALLBACK_LOCALE=id
 APP_FAKER_LOCALE=id_ID

 DB_CONNECTION=mysql
 DB_DATABASE=techup
```

Untuk melakukan uji coba pengiriman email menggunakan Mailtrap:

```bash
 MAIL_MAILER=smtp
 MAIL_HOST=sandbox.smtp.mailtrap.io
 MAIL_PORT=2525
 MAIL_USERNAME=your_mailtrap_username # Username dapat ditemukan di dashboard Mailtrap
 MAIL_PASSWORD=your_mailtrap_password # Password juga dapat ditemukan di dashboard Mailtrap
 MAIL_ENCRYPTION=tls
 MAIL_FROM_ADDRESS=your_email@example.com
 MAIL_FROM_NAME="${APP_NAME}"
```

## Running a website

```bash
 php artisan serve
```

## Login With Admin

Account = `admin@role.id`

Password = `admin123`
