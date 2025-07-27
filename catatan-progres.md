# Laravel CRUD

Latihan Laravel 12, nyoba eksplor banyak fitur dari Laravel di CRUD sederhana ini.

---

**Table**
1. users
2. blogs
3. tags
4. blog_tag

**Model**
1. User
2. Blog
3. Tag

**Factory**
1. UserFactory
2. BlogFactory
3. TagFactory

**Seeder**
1. UserSeeder
2. BlogSeeder
3. TagSeeder

Terus dipanggil semua seedernya di [DatabaseSeeder.php](database/seeders/DatabaseSeeder.php)

---

## TODO
- [x] [Table, model relasi & factory](#table-model-relasi--factory)
- [x] [Kerangka tampilan](#kerangka-tampilan)
- [x] [Register, login & logout (tanpa tambahan lain)](#register-login--logout)
- [x] [CRUD blog](#crud-blog)
- [x] [Hak akses](#hak-akses) *(bareng CRUD blog)*
- [x] [Fitur cari](#fitur-pencarian)
- [x] [CRUD user (profil)](#crud-user-profil)
- [x] [Feedback CRUD](#hal-lain-lumayan-nyambung-crud-user)  
	- Notif berhasil atau error
	- Konfirmasi sebelum hapus
- [x] [Email](#kirim-email)
- [x] [Login rate limit](#login-rate-limit)
- [x] [Pasang foto profil di navbar, hasil pencarian user & edit profil](#penggunaan-foto-profil)
- [x] [Refactor javascript](#refactor)

---

## Rincian Alur Proses

### Table, Model Relasi & Factory
- `php artisan make:model Blog -mfscr`
- `php artisan make:model Tag -mfscr`

Table penghubung `blogs` sama `tags` ga usah dibikin model, factory dll nya.  
Cukup model buat 2 table utama aja, terus nama table penghubungnya bentuk satuan dari 2 nama table utama.  
`blogs` & `tags` berhubungan jadi `blog_tag`

Cek:
- [Blog.php](app/Models/Blog.php)
- [Tag.php](app/Models/Tag.php)
- Bagian `attach` di [BlogSeeder.php](database/seeders/BlogSeeder.php)

---

### Kerangka Tampilan

Full bikin kerangka tampilan di [index.blade.php](resources/views/blogs/index.blade.php) terus bertahap dipisahin ke komponen:

- `php artisan make:component layout --view`
- `php artisan make:component tag --view`
- `php artisan make:component article-panel --view`
- `php artisan make:component blog-card --view`

Sisanya bikin manual xD

#### File tampilan baru:
- Folder resources/views/auth:  
	register & login.

- Folder resources/views/blogs:  
	index, show, create & edit

- Folder resources/views/components:  
	layout, article-panel, blog-card, tag & divider.

- Folder resources/views/components/forms:  
	form, field, input, label, error, tags, button & link.

#### Progres kecil lain:
- Nambah variable warna di [app.css](resources/css/app.css)
- Ngubah [BlogFactory.php](database/factories/BlogFactory.php) isi blog biar maks 3000 karakter

---

### Register, Login & Logout
`php artisan lang:publish`

Ganti `FILESYSTEM_DISK` di [.env](.env) jadi public, asalnya local. 
`php artisan storage:link`

- [RegisteredUserController.php](app/Http/Controllers/RegisteredUserController.php)
- [register.blade.php](resources/views/auth/register.blade.php)
- [SessionController.php](app/Http/Controllers/SessionController.php)
- [login.blade.php](resources/views/auth/login.blade.php)

---

### CRUD Blog

#### Nambah Laravel Debugbar
[laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

	composer require barryvdh/laravel-debugbar --dev

Mau liat kenapa yg show ga termasuk lazy loading.  
Soalnya nyoba pake `Model::preventLazyLoading();` di [AppServiceProvider.php](app/Providers/AppServiceProvider.php) ga ada error buat show, cuma pas nyoba lazy loading di index errornya.

#### Nambah Slug di Table Tag & Blog:
- Nambahin field slug di migration [Tag](database/migrations/2025_07_17_114735_create_tags_table.php)
- Nambahin buat bikin slug otomatis di model [Tag.php](app/Models/Tag.php)
- Nambahin buat bikin slug otomatis di model [Blog.php](app/Models/Blog.php)

Baru sadar belakangan harusnya bikin migration baru, bukan edit file migration yg udh ada kalo beneran mau eksplor fitur-fitur Laravel.

#### Nambah Fungsi Buat Motong Isi Blog
- [app/Models/Blog.php](app/Models/Blog.php)  
	contoh manggilnya di [resources/views/components/blog-card.blade.php](resources/views/components/blog-card.blade.php) `$blog->excerpt`

#### Nambah Tanggal Random buat Blog
- [BlogFactory.php](database/factories/BlogFactory.php)

#### Modifikasi komponen biar bisa dipake buat create & edit sekaligus:
- Nambahin props `value` di [input.blade.php](resources/views/components/forms/input.blade.php)
- [tags.blade.php](resources/views/components/forms/tags.blade.php)
- Nambahin pesan error validasi di file [bahasa](lang/id/validation.php)

#### Format String buat Nampilin Isi Blog
- Liat aja di [show.blade.php](resources/views/blogs/show.blade.php)
- Sama cek route contoh-string

#### Hak Akses
- Bikin *gate* di [AppServiceProvider.php](app/Providers/AppServiceProvider.php)
	- Pake di [routes](routes/web.php)
	- Pake di [show](resources/views/blogs/show.blade.php) buat button edit & hapus

#### Progres Kecil Lain (yg Ga Berhubungan sama CRUD Blog)
- Nambahin validasi `'nullable'` di [RegisteredUserController.php](app/Http/Controllers/RegisteredUserController.php).
- Ngubah redirect abis login biar balik ke halaman sebelumnya di [SessionController.php](app/Http/Controllers/SessionController.php).
- Nambahin required di form register & login.
- Ngubah link di [layout](resources/views/components/layout.blade.php) sama di halaman register & login jadi pake nama route.

---

> **Catatan:** Nambahin fungsi kayak slug, isi blog & ngubah tanggal di model itu disebutnya *Accessor & Mutator* 
>  
> *Accessor*:
> 	- Namanya fungsinya: `getNamaBebasAttribute` *(bebas mau sesuai field di table atau apapun)*  
> 	- Cara manggilnya: `->nama_bebas`  
> 	- Fungsinya: ngakses data dari database & kita modifikasi dulu sebelum ditampilin.  
> 
> *Mutator*:
> 	- Namanya fungsinya: `setNamaFieldAttribute` *(harus nama field di tablenya)*  
> 	- Cara pakenya: otomatis kepake pas masukin data *field*nya ke database pake `create()`, `save()` sama `update()`  
> 	- Fungsinya: modifikasi data sebelum dimasukin ke database  
> 
> Nama fungsinya mungkin emang harus dimulai pake "set" atau "get" terus akhirnya "Attribute".

---

### Fitur Pencarian

- Route pake *invokeable [controller](app/Http/Controllers/SearchController.php)*
- Ngubah form pencarian di [layout.blade.php](resources/views/components/layout.blade.php)
- Nambah tampilan [results.blade.php](resources/views/blogs/results.blade.php)
- Ngubah link author & tag di [blog-card.blade.php](resources/views/components/blog-card.blade.php) sama [show.blade.php](resources/views/blogs/show.blade.php) jadi [komponen](resources/views/components/blog-info.blade.php)

---

### CRUD User (Profil)
- [ProfileController.php](app/Http/Controllers/ProfileController.php)
- Ngubah foreign id di blog biar delete on cascade pake [migration](database/migrations/2025_07_23_125758_update_user_id_foreign_on_blogs.php)

#### Hal Lain (Lumayan Nyambung CRUD User):
- Ngubah locale di [config/app.php](config/app.php) biar mastiin bener pake locale id.
- Ngubah default [filesystem](config/filesystems.php) jadi public.
- Nambahin tombol kembali buat di [show.blade.php](resources/views/blogs/show.blade.php)
- Nambahin notifikasi buat CRUD blog [BlogController.php](app/Http/Controllers/BlogController.php)
- Benerin fitur pencarian [SearchController.php](app/Http/Controllers/SearchController.php)

---

### Kirim Email

#### `php artisan make:mail`
- BlogPosted
- UserDeleted


#### Nambahin queue di *controller*nya:
- [BlogController.php](app/Http/Controllers/BlogController.php) `store()`
- [ProfileController.php](app/Http/Controllers/ProfileController.php) `destroy()`

Kalo jalanin aplikasinya pake *command* `composer run dev`, ga usah jalanin `php artisan queue:work`.  
Kalo worknya ga jalan, coba tutup browser & restart *command* `composer run dev`nya.

> Once the application has been created, you can start Laravel's local development server, queue worker, and Vite development server using the dev Composer script:  
> composer run dev

Itu dari dokumen resmi Laravelnya.

Awalnya nyoba pake [log](storage/logs/laravel.log) dulu, berhasil. Terus coba pake [mailtrap.io](https://mailtrap.io/).

Setting di [.env](.env) buat nyambungin ke *mailtrap*nya.

---

### Login Rate Limit
- [SessionController.php](app/Http/Controllers/SessionController.php) `sotre()`
- Nambahin menit di [lang/id/auth.php](lang/id/auth.php)

`php artisan cache:clear` buat ngilangin rate limitnya pas lagi nyobain.

Settingan cachenya ga ada yg diubah, default dari Laravelnya.  
Cachenya masuk ke database table cache. Kalo pake *command* di atas, bakal ngehapus semua yg ada di table cache.

---

### Penggunaan Foto Profil
Foto profil awalnya cuma buat nyobain upload gambar. Sekarang sekalian beneran pake di webnya.

Nampilin foto profil di:
- [layout header](resources/views/components/layout.blade.php)
- Halaman hasil pencarian
	- [results.blade.php](resources/views/blogs/results.blade.php)
	- [SearchController.php](app/Http/Controllers/SearchController.php)
- [edit.blade.php](resources/views/profile/edit.blade.php)
- [register.blade.php](resources/views/auth/register.blade.php)

#### Hal Lain:
- Benerin [BlogSeeder](database/seeders/BlogSeeder.php) biar bener-bener random tagnya
- Nambahin *accessor* buat nama depan di [User.php](app/Models/User.php)

---

### Refactor

Ngerasa udh selesai web CRUD ini, udh eksplor banyak fitur dari Laravel.  
Terus nanya ke AI soal penempatan javascript di dalem komponen.  
Bagusnya javascript dipisah terus dipanggil sama Vite, nanti biar dikompres sama Vite.

	npm run build

- **Bikin/pindahin ke file.js:**
	- [modal.js](resources/js/components/modal.js)
	- [profilePicture.js](resources/js/components/profilePicture.js)

- **Import & jalanin/panggil fungsinya di [app.js](resources/js/app.js)**

- **Import file.jsnya di [layout.blade.php](resources/views/components/layout.blade.php) pake Vite**

- **Komponen yg scriptnya dipindahin:**
	- [delete-confirmation.blade.php](resources/views/components/forms/delete-confirmation.blade.php)
	- [status-notif.blade.php](resources/views/components/status-notif.blade.php)
	- [input-picture.blade.php](resources/views/components/forms/input-picture.blade.php)

#### Selain javascript:
- **Error duplikat slug blog**
	- `php artisan make:observer BlogObserver --model=Blog`
		- [BlogObserver.php](app/Observers/BlogObserver.php)
		- Jalanin *observer*nya di [AppServiceProvider.php](app/Providers/AppServiceProvider.php)
	- Ngehapus slug di mutator [Blog.php](app/Models/Blog.php)

- **Search controller jadi pake `when()` juga**
	- [app/Http/Controllers/SearchController.php](app/Http/Controllers/SearchController.php)

---

### Benerin File Migration

File migration aman pas pake SQLite tapi pas nyoba pake MySQL ternyata banyak yg error pas jalanin `php artisan migrate`.

Mau benerin pake file migration baru tapi bingung gara-gara kebanyakan yg errornya.  
Jadi ngedit file migration yg udh ada aja.

---

### Benerin Front-End Fitur Pencarian

Sekarang kalo hasil pencariannya udh ada filter user, pas ngeklik tag, usernya ga ilang, sebaliknya juga.

Sebenernya di bagian back-end udh bisa dari sebelumnya jg, cuma di font-end belum.  
Sebelumnya harus ngetik manual di bar pencarian browsernya.

---

---

---


Malah pusing di awal pas bikin tampilan tapi akhirnya ga dipake ini xD  
Kurang imajinasi buat bikin tampilan yg bagus.  
[coolors.co](https://coolors.co/f53003-201e1f-feefdd-50b2c0-c200fb)

```css
/* CSS HEX */
--scarlet: #f53003ff;
--raisin-black: #201e1fff;
--antique-white: #feefddff;
--moonstone: #50b2c0ff;
--electric-purple: #c200fbff;

/* CSS HSL */
--scarlet: hsla(11, 98%, 49%, 1);
--raisin-black: hsla(330, 3%, 12%, 1);
--antique-white: hsla(33, 94%, 93%, 1);
--moonstone: hsla(188, 47%, 53%, 1);
--electric-purple: hsla(286, 100%, 49%, 1);

/* SCSS HEX */
$scarlet: #f53003ff;
$raisin-black: #201e1fff;
$antique-white: #feefddff;
$moonstone: #50b2c0ff;
$electric-purple: #c200fbff;

/* SCSS HSL */
$scarlet: hsla(11, 98%, 49%, 1);
$raisin-black: hsla(330, 3%, 12%, 1);
$antique-white: hsla(33, 94%, 93%, 1);
$moonstone: hsla(188, 47%, 53%, 1);
$electric-purple: hsla(286, 100%, 49%, 1);

/* SCSS RGB */
$scarlet: rgba(245, 48, 3, 1);
$raisin-black: rgba(32, 30, 31, 1);
$antique-white: rgba(254, 239, 221, 1);
$moonstone: rgba(80, 178, 192, 1);
$electric-purple: rgba(194, 0, 251, 1);

/* SCSS Gradient */
$gradient-top: linear-gradient(0deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-right: linear-gradient(90deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-bottom: linear-gradient(180deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-left: linear-gradient(270deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-top-right: linear-gradient(45deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-bottom-right: linear-gradient(135deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-top-left: linear-gradient(225deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-bottom-left: linear-gradient(315deg, #f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
$gradient-radial: radial-gradient(#f53003ff, #201e1fff, #feefddff, #50b2c0ff, #c200fbff);
```