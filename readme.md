

## KASKU - APLIKASI MANAJEMEN KAS MAHASISWA

KASKU adalah aplikasi opens source yang dikembangkan untuk mencatat kas keuangan mahasiswa, seperti keuangan masuk / debit dan keuangan keluar / credit. Beberapa fitur diantaranya:

- Daftar (Development)
- Masuk / Login
- Lupa Password (Development)
- Dashboard
- Kategori Uang Masuk
- Uang Masuk
- Kategori Uang keluar
- Uang keluar

KASKU juga akan dibuat versi native android, yang rencana akan di kembangkan dengan android studi / java.
Untuk versi webnya menggunakan Framework Laravel

**NOTE**: template admin menggunakan stisla, untuk lebih lengkapnya bisa kunjungi situs resminya di: https://getstisla.com/

## Screenshot
LOGIN
<img width="1803" height="859" alt="Screenshot 2026-01-02 222150" src="https://github.com/user-attachments/assets/089dae8f-91ee-4565-aba8-6aadf2fe0cc3" />
DAFTAR
<img width="1910" height="854" alt="Screenshot 2026-01-03 202019" src="https://github.com/user-attachments/assets/60c8ea2a-ab93-4479-ae06-ea4d66b628e6" />
DASHBOARD
<img width="1918" height="853" alt="image" src="https://github.com/user-attachments/assets/13ebd04a-84b8-4f89-afda-7b46a5459431" />
TAMBAH MAHASISWA
<img width="1919" height="873" alt="Screenshot 2026-01-02 223204" src="https://github.com/user-attachments/assets/2de0a4fb-d11f-41f2-89cb-2264c27b3358" />
<img width="1914" height="855" alt="Screenshot 2026-01-02 232714" src="https://github.com/user-attachments/assets/39d33126-a604-4c64-be8c-4306ce373733" />
HAPUS MAHASISWA
<img width="1915" height="863" alt="Screenshot 2026-01-02 233051" src="https://github.com/user-attachments/assets/c2e3bbe2-694e-44d8-ac10-8f7437117eee" />
<img width="1902" height="852" alt="Screenshot 2026-01-02 233106" src="https://github.com/user-attachments/assets/6280d4bd-ef68-4d5e-8dc0-e18596bef71e" />




## Cara Install

`$ > git clone https://github.com/Rizalmuhaimin123/SISTEM-INFORMASI-KAS-_-KAS-MAHASISWA.git`

`$ > cd uangku-laravel`

`$ > composer install`

`$ > cp env.example .env`

silahkan konfigurasi pengaturan database, seperti host, user, password dan nama database

`$ > composer dump-autoload`

`$ > php artisan migrate`

`$ > php artisan db:seed`


USERNAME : admin

PASSWORD : admin

## Cara Menjalankan

`$ > cd uangku-laravel`

`$ > php artisan serve`

Silahkan buka browser dan ketikkan : http://localhost:8000

## License

KASKU is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
