# Latihan CRUD Laravel

Latihan Laravel 12, nyoba eksplor banyak fitur dari Laravel di CRUD sederhana ini.

[catatan progres](catatan-progres.md)

### Catatan Buat Sendiri
<sup>(kalo lupa)</sup>

1. Install dependencies

		composer install
		npm install
		npm run build

2. Copy `.env` file.  
	yg butuh diubah cuma mailer, ini pake mailtrap,io tp bisa juga laravel.log doang. Sisanya udh diubah di config.

3. Generate `APP_KEY`

		php artisan key:generate

4. Database
	Pake SQLite (yg default aja)

		php artisan migrate:fresh --seed

	Pake `fresh` jaga-jaga kalo file `database.sqlite`nya udh ada data.

5. Jalanin aplikasinya

		composer run dev

	atau masukin ke XAMPP, Laragon dan sejenisnya.

		php artisan queue:work

	Jalanin itu buat ngirim email kalo **bukan** pake `composer run dev`

6. Info login  
	`admin@example.test`  
	`password`

	Semua password user yg pake seeder: `password`
