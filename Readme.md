# BEM E-Voting System — Laravel

## Langkah Instalasi
1. `git clone https://github.com/FauruxD/E-Voting.git`
2. `cd e-voting_bem`
3. `composer install`
4. `npm install`
5. `npm run build`
6. `copy .env.example .env`
7. `php artisan key:generate`
8. `php artisan migrate:fresh --seed`
9. `php artisan storage:link`
10. `php artisan serve`

---

## 1. Overview

BEM E-Voting System adalah aplikasi web berbasis Laravel untuk pemilihan umum BEM secara digital. Sistem ini digunakan oleh mahasiswa sebagai pemilih dan admin/panitia sebagai pengelola pemilu.

Sistem memiliki tampilan dark mode modern dengan aksen warna kuning neon, mengikuti konsep desain pada mockup: login card bergaya glassmorphism, daftar paslon berbentuk card, halaman detail kandidat, halaman hasil real-time, serta admin dashboard untuk mengelola kandidat, pemilih, hasil suara, dan pengaturan sistem.

---

## 2. Tujuan Sistem

Tujuan utama sistem:

- Memudahkan mahasiswa melakukan voting secara online.
- Mencegah pemilih melakukan voting lebih dari satu kali.
- Memudahkan admin mengelola data pemilih dan kandidat.
- Menampilkan hasil voting secara real-time atau berkala.
- Memberikan pengalaman voting yang modern, aman, dan mudah digunakan.

---

## 3. Tech Stack

Recommended stack:

- Laravel 11 / Laravel 12
- PHP 8.2+
- MySQL 8+ atau MariaDB
- Blade Template
- Tailwind CSS
- Alpine.js
- Laravel Session Auth
- Laravel Migration & Seeder

Optional package:

- `maatwebsite/excel` untuk import data pemilih dari Excel.
- `barryvdh/laravel-dompdf` untuk export hasil voting ke PDF.
- `spatie/laravel-permission` jika ingin role management lebih kompleks.

---

## 4. User Role

## 4.1 Pemilih / Mahasiswa

Pemilih adalah mahasiswa yang sudah terdaftar dalam DPT.

Hak akses:

- Login menggunakan NPM dan PIN.
- Melihat daftar pasangan calon.
- Melihat detail kandidat.
- Memberikan suara satu kali.
- Melihat hasil voting jika dipublikasikan admin.
- Logout.

## 4.2 Admin / Panitia

Admin adalah pengguna yang mengelola sistem e-voting.

Hak akses:

- Login ke admin dashboard.
- Melihat statistik pemilihan.
- Mengelola data pemilih.
- Mengelola data kandidat.
- Melihat hasil voting.
- Membuka atau menutup voting.
- Menampilkan atau menyembunyikan hasil voting.
- Logout.

---

## 5. Design & Theme

## 5.1 Konsep Desain

Style utama:

- Dark mode.
- Modern dashboard.
- Minimalis.
- Rounded card.
- Soft shadow.
- Neon accent.
- Glassmorphism pada login page.
- Layout bersih dan responsif.

## 5.2 Color Palette

| Elemen | Warna |
|---|---|
| Background utama | `#0D0D0D` |
| Background card | `#161616` |
| Border | `#2A2A2A` |
| Primary accent | `#E8F06A` |
| Primary hover | `#DCE850` |
| Text utama | `#FFFFFF` |
| Text secondary | `#A0A0A0` |
| Success | `#22C55E` |
| Danger | `#EF4444` |
| Warning | `#F59E0B` |

## 5.3 Typography

Font yang direkomendasikan:

- Poppins
- Inter

Penggunaan:

| Elemen | Font Weight |
|---|---|
| Heading | 700 |
| Subheading | 600 |
| Body | 400 |
| Caption | 300 |

## 5.4 Komponen UI

Komponen utama:

- Navbar
- Sidebar admin
- Login card
- Candidate card
- Stats card
- Button
- Input field
- Badge status
- Table
- Progress bar
- Countdown timer
- Modal confirmation
- Toast notification
- Footer

---

## 6. Fitur Sistem

## 6.1 Fitur Pemilih

### Login Pemilih

Pemilih login menggunakan NPM dan PIN.

Fitur:

- Input NPM.
- Input PIN.
- Show/hide PIN.
- Remember me.
- Validasi login.
- Redirect berdasarkan role.

Rules:

- NPM harus terdaftar.
- PIN harus sesuai.
- User harus aktif.
- Jika user adalah admin, redirect ke admin dashboard.
- Jika user adalah voter, redirect ke dashboard pemilih.

### Dashboard Pemilih

Fitur:

- Menampilkan daftar pasangan calon.
- Menampilkan nomor urut kandidat.
- Menampilkan nama ketua dan wakil.
- Menampilkan ringkasan visi.
- Menampilkan countdown waktu voting.
- Tombol pilih kandidat.

Rules:

- Jika voting belum dibuka, tombol voting disabled.
- Jika voting sudah ditutup, tombol voting disabled.
- Jika pemilih sudah memilih, tombol voting disabled.

### Detail Kandidat

Fitur:

- Foto kandidat.
- Nomor urut.
- Nama ketua.
- Nama wakil.
- Fakultas.
- Jurusan.
- Angkatan.
- Visi.
- Misi.
- Program kerja.
- Tombol konfirmasi voting.

### Submit Voting

Rules:

- Pemilih hanya boleh voting satu kali.
- Vote tidak dapat diubah.
- Vote hanya bisa dilakukan saat voting aktif.
- Vote hanya bisa dilakukan dalam jadwal voting.
- Setelah vote berhasil, status user berubah menjadi `has_voted = true`.

### Hasil Voting Publik

Fitur:

- Total suara masuk.
- Total DPT.
- Tingkat partisipasi.
- Persentase tiap kandidat.
- Progress bar hasil kandidat.

Rules:

- Hasil hanya muncul jika admin mengaktifkan `result_visibility`.
- Jika hasil belum dipublikasikan, tampilkan pesan bahwa hasil belum tersedia.

---

## 6.2 Fitur Admin

### Admin Dashboard

Fitur:

- Total DPT.
- Total suara masuk.
- Total belum memilih.
- Tingkat partisipasi.
- Status voting.
- Ringkasan hasil kandidat.

### Manajemen Pemilih

Fitur:

- Melihat daftar pemilih.
- Search pemilih.
- Tambah pemilih.
- Edit pemilih.
- Hapus pemilih.
- Import pemilih dari Excel atau CSV.
- Melihat status sudah/belum memilih.
- Generate atau reset PIN.

### Manajemen Kandidat

Fitur:

- Melihat daftar kandidat.
- Tambah kandidat.
- Edit kandidat.
- Hapus kandidat.
- Upload foto kandidat.
- Mengatur nomor urut.
- Mengatur status kandidat: `verified` atau `pending`.

### Hasil Voting Admin

Fitur:

- Total suara.
- Jumlah suara setiap kandidat.
- Persentase suara setiap kandidat.
- Tingkat partisipasi.
- Waktu terakhir diperbarui.
- Export hasil ke PDF.

### Pengaturan Sistem

Fitur:

- Buka voting.
- Tutup voting.
- Atur jadwal mulai voting.
- Atur jadwal selesai voting.
- Tampilkan hasil ke publik.
- Sembunyikan hasil dari publik.
- Mengubah nama aplikasi dan judul pemilihan.

---

# 7. Struktur Database

Database utama terdiri dari lima tabel inti:

1. `users`
2. `candidates`
3. `votes`
4. `settings`
5. `audit_logs`

Relasi utama:

- Satu `user` dengan role `voter` hanya boleh memiliki satu `vote`.
- Satu `candidate` bisa memiliki banyak `votes`.
- `settings` menyimpan konfigurasi sistem voting.
- `audit_logs` menyimpan aktivitas penting user/admin.

---

## 7.1 Entity Relationship Overview

```text
users
  └── hasOne votes

candidates
  └── hasMany votes

votes
  ├── belongsTo users
  └── belongsTo candidates

settings
  └── standalone configuration table

audit_logs
  └── belongsTo users nullable
```

---

## 7.2 Tabel `users`

Tabel ini menyimpan data pemilih dan admin.

### Fungsi

- Menyimpan data akun.
- Menentukan role user.
- Menyimpan status apakah pemilih sudah voting.
- Menyimpan PIN dalam bentuk hash.

### Struktur

| Field | Type | Constraint | Keterangan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | ID user |
| `npm` | VARCHAR(30) | Unique, Not Null | NPM mahasiswa atau username admin |
| `name` | VARCHAR(255) | Not Null | Nama lengkap user |
| `faculty` | VARCHAR(255) | Nullable | Fakultas user |
| `major` | VARCHAR(255) | Nullable | Jurusan user |
| `pin` | VARCHAR(255) | Not Null | PIN login yang sudah di-hash |
| `role` | ENUM | Default: `voter` | Role: `voter` atau `admin` |
| `has_voted` | BOOLEAN | Default: false | Status apakah user sudah memilih |
| `is_active` | BOOLEAN | Default: true | Status akun aktif/tidak |
| `remember_token` | VARCHAR(100) | Nullable | Token remember me Laravel |
| `created_at` | TIMESTAMP | Nullable | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Nullable | Waktu data diperbarui |

### Index

| Index | Field |
|---|---|
| Unique | `npm` |
| Index | `role` |
| Index | `has_voted` |
| Index | `is_active` |

### Laravel Migration

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('npm')->unique();
    $table->string('name');
    $table->string('faculty')->nullable();
    $table->string('major')->nullable();
    $table->string('pin');
    $table->enum('role', ['voter', 'admin'])->default('voter');
    $table->boolean('has_voted')->default(false);
    $table->boolean('is_active')->default(true);
    $table->rememberToken();
    $table->timestamps();

    $table->index('role');
    $table->index('has_voted');
    $table->index('is_active');
});
```

---

## 7.3 Tabel `candidates`

Tabel ini menyimpan data pasangan calon BEM.

### Fungsi

- Menyimpan nomor urut kandidat.
- Menyimpan nama ketua dan wakil.
- Menyimpan visi, misi, dan program kerja.
- Menyimpan status verifikasi kandidat.

### Struktur

| Field | Type | Constraint | Keterangan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | ID kandidat |
| `serial_number` | INT | Unique, Not Null | Nomor urut kandidat |
| `chairman_name` | VARCHAR(255) | Not Null | Nama calon ketua |
| `vice_name` | VARCHAR(255) | Not Null | Nama calon wakil |
| `faculty` | VARCHAR(255) | Nullable | Fakultas kandidat |
| `major` | VARCHAR(255) | Nullable | Jurusan kandidat |
| `batch` | VARCHAR(50) | Nullable | Angkatan kandidat |
| `vision` | TEXT | Not Null | Visi kandidat |
| `mission` | LONGTEXT | Not Null | Misi kandidat |
| `work_programs` | JSON | Nullable | Program kerja kandidat |
| `photo` | VARCHAR(255) | Nullable | Path foto kandidat |
| `status` | ENUM | Default: `pending` | `verified` atau `pending` |
| `created_at` | TIMESTAMP | Nullable | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Nullable | Waktu data diperbarui |

### Index

| Index | Field |
|---|---|
| Unique | `serial_number` |
| Index | `status` |
| Index | `serial_number` |

### Format `work_programs`

`work_programs` disimpan dalam format JSON agar satu kandidat bisa memiliki banyak program kerja.

Contoh:

```json
[
  {
    "title": "Tech Connect Festival",
    "description": "Festival teknologi, hackathon, dan networking industri."
  },
  {
    "title": "Portal Beasiswa & Info Akademik",
    "description": "Pusat informasi akademik dan beasiswa mahasiswa."
  }
]
```

### Laravel Migration

```php
Schema::create('candidates', function (Blueprint $table) {
    $table->id();
    $table->integer('serial_number')->unique();
    $table->string('chairman_name');
    $table->string('vice_name');
    $table->string('faculty')->nullable();
    $table->string('major')->nullable();
    $table->string('batch')->nullable();
    $table->text('vision');
    $table->longText('mission');
    $table->json('work_programs')->nullable();
    $table->string('photo')->nullable();
    $table->enum('status', ['verified', 'pending'])->default('pending');
    $table->timestamps();

    $table->index('status');
    $table->index('serial_number');
});
```

---

## 7.4 Tabel `votes`

Tabel ini menyimpan suara yang diberikan pemilih.

### Fungsi

- Menyimpan pilihan user.
- Mencegah user voting lebih dari satu kali.
- Menjadi sumber utama perhitungan hasil voting.

### Struktur

| Field | Type | Constraint | Keterangan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | ID vote |
| `user_id` | BIGINT UNSIGNED | Foreign Key, Unique, Not Null | ID pemilih |
| `candidate_id` | BIGINT UNSIGNED | Foreign Key, Not Null | ID kandidat yang dipilih |
| `voted_at` | TIMESTAMP | Default current timestamp | Waktu voting |
| `created_at` | TIMESTAMP | Nullable | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Nullable | Waktu data diperbarui |

### Relasi

| Field | References | On Delete |
|---|---|---|
| `user_id` | `users.id` | Cascade |
| `candidate_id` | `candidates.id` | Cascade |

### Index

| Index | Field | Fungsi |
|---|---|---|
| Unique | `user_id` | Mencegah user voting dua kali |
| Index | `candidate_id` | Mempercepat hitung suara kandidat |
| Index | `voted_at` | Mempercepat filter waktu voting |

### Laravel Migration

```php
Schema::create('votes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
    $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
    $table->timestamp('voted_at')->useCurrent();
    $table->timestamps();

    $table->index('candidate_id');
    $table->index('voted_at');
});
```

---

## 7.5 Tabel `settings`

Tabel ini menyimpan konfigurasi sistem e-voting.

### Fungsi

- Menentukan apakah voting sedang dibuka atau ditutup.
- Menentukan apakah hasil voting ditampilkan ke publik.
- Menyimpan jadwal mulai dan selesai voting.
- Menyimpan judul pemilihan.

### Struktur

| Field | Type | Constraint | Keterangan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | ID setting |
| `app_name` | VARCHAR(255) | Default: `BEM E-Voting` | Nama aplikasi |
| `election_title` | VARCHAR(255) | Default: `Pemilihan Umum BEM 2026` | Judul pemilihan |
| `voting_status` | ENUM | Default: `closed` | Status: `open` atau `closed` |
| `result_visibility` | BOOLEAN | Default: false | Status hasil publik |
| `voting_start` | DATETIME | Nullable | Jadwal mulai voting |
| `voting_end` | DATETIME | Nullable | Jadwal selesai voting |
| `created_at` | TIMESTAMP | Nullable | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Nullable | Waktu data diperbarui |

### Laravel Migration

```php
Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('app_name')->default('BEM E-Voting');
    $table->string('election_title')->default('Pemilihan Umum BEM 2026');
    $table->enum('voting_status', ['open', 'closed'])->default('closed');
    $table->boolean('result_visibility')->default(false);
    $table->dateTime('voting_start')->nullable();
    $table->dateTime('voting_end')->nullable();
    $table->timestamps();
});
```

---

## 7.6 Tabel `audit_logs`

Tabel ini menyimpan riwayat aktivitas penting di sistem.

### Fungsi

- Mencatat aktivitas login.
- Mencatat aktivitas voting.
- Mencatat perubahan data oleh admin.
- Membantu proses audit jika terjadi masalah.

### Struktur

| Field | Type | Constraint | Keterangan |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | ID log |
| `user_id` | BIGINT UNSIGNED | Foreign Key, Nullable | User yang melakukan aksi |
| `action` | VARCHAR(255) | Not Null | Nama aktivitas |
| `ip_address` | VARCHAR(45) | Nullable | IP address user |
| `user_agent` | TEXT | Nullable | Browser/device user |
| `metadata` | JSON | Nullable | Data tambahan aktivitas |
| `created_at` | TIMESTAMP | Nullable | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Nullable | Waktu data diperbarui |

### Relasi

| Field | References | On Delete |
|---|---|---|
| `user_id` | `users.id` | Set Null |

### Contoh Action

| Action | Keterangan |
|---|---|
| `login_success` | User berhasil login |
| `login_failed` | User gagal login |
| `vote_submitted` | User berhasil voting |
| `candidate_created` | Admin menambahkan kandidat |
| `candidate_updated` | Admin mengubah kandidat |
| `candidate_deleted` | Admin menghapus kandidat |
| `voter_created` | Admin menambahkan pemilih |
| `setting_updated` | Admin mengubah pengaturan |

### Laravel Migration

```php
Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
    $table->string('action');
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamps();

    $table->index('action');
    $table->index('created_at');
});
```

---

# 8. SQL Schema Lengkap

```sql
CREATE DATABASE IF NOT EXISTS evoting_bem
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE evoting_bem;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    npm VARCHAR(30) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    faculty VARCHAR(255) NULL,
    major VARCHAR(255) NULL,
    pin VARCHAR(255) NOT NULL,
    role ENUM('voter', 'admin') NOT NULL DEFAULT 'voter',
    has_voted BOOLEAN NOT NULL DEFAULT FALSE,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_users_role (role),
    INDEX idx_users_has_voted (has_voted),
    INDEX idx_users_is_active (is_active)
);

CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    app_name VARCHAR(255) NOT NULL DEFAULT 'BEM E-Voting',
    election_title VARCHAR(255) NOT NULL DEFAULT 'Pemilihan Umum BEM 2026',
    voting_status ENUM('open', 'closed') NOT NULL DEFAULT 'closed',
    result_visibility BOOLEAN NOT NULL DEFAULT FALSE,
    voting_start DATETIME NULL,
    voting_end DATETIME NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE candidates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    serial_number INT NOT NULL UNIQUE,
    chairman_name VARCHAR(255) NOT NULL,
    vice_name VARCHAR(255) NOT NULL,
    faculty VARCHAR(255) NULL,
    major VARCHAR(255) NULL,
    batch VARCHAR(50) NULL,
    vision TEXT NOT NULL,
    mission LONGTEXT NOT NULL,
    work_programs JSON NULL,
    photo VARCHAR(255) NULL,
    status ENUM('verified', 'pending') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_candidates_status (status),
    INDEX idx_candidates_serial_number (serial_number)
);

CREATE TABLE votes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    candidate_id BIGINT UNSIGNED NOT NULL,
    voted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_votes_user_id
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_votes_candidate_id
        FOREIGN KEY (candidate_id) REFERENCES candidates(id)
        ON DELETE CASCADE,
    INDEX idx_votes_candidate_id (candidate_id),
    INDEX idx_votes_voted_at (voted_at)
);

CREATE TABLE audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    metadata JSON NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_audit_logs_user_id
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE SET NULL,
    INDEX idx_audit_logs_user_id (user_id),
    INDEX idx_audit_logs_action (action),
    INDEX idx_audit_logs_created_at (created_at)
);
```

---

# 9. Laravel Model Relationship

## 9.1 User Model

```php
public function vote()
{
    return $this->hasOne(Vote::class);
}

public function auditLogs()
{
    return $this->hasMany(AuditLog::class);
}

public function isAdmin()
{
    return $this->role === 'admin';
}

public function isVoter()
{
    return $this->role === 'voter';
}
```

## 9.2 Candidate Model

```php
public function votes()
{
    return $this->hasMany(Vote::class);
}
```

## 9.3 Vote Model

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function candidate()
{
    return $this->belongsTo(Candidate::class);
}
```

## 9.4 AuditLog Model

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

---

# 10. Folder Structure Laravel

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── VotingController.php
│   │   ├── ResultController.php
│   │   ├── CandidatePublicController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── VoterController.php
│   │       ├── CandidateController.php
│   │       ├── ResultController.php
│   │       └── SettingController.php
│   ├── Middleware/
│   │   └── RoleMiddleware.php
│   └── Requests/
│       ├── LoginRequest.php
│       ├── VoterRequest.php
│       ├── CandidateRequest.php
│       └── SettingRequest.php
├── Models/
│   ├── User.php
│   ├── Candidate.php
│   ├── Vote.php
│   ├── Setting.php
│   └── AuditLog.php
└── Services/
    ├── VotingService.php
    ├── ResultService.php
    └── AuditLogService.php
```

---

# 11. Route Structure

```php
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:voter'])->group(function () {
    Route::get('/dashboard', [VotingController::class, 'index'])->name('voter.dashboard');
    Route::get('/candidates/{candidate}', [CandidatePublicController::class, 'show'])->name('candidates.show');
    Route::post('/vote/{candidate}', [VotingController::class, 'store'])->name('vote.store');
    Route::get('/results', [ResultController::class, 'public'])->name('results.public');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/voters', Admin\VoterController::class);
        Route::resource('/candidates', Admin\CandidateController::class);
        Route::get('/results', [Admin\ResultController::class, 'index'])->name('results.index');
        Route::get('/settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
```

---

# 12. Business Rules

Rules utama:

1. User login menggunakan NPM dan PIN.
2. PIN wajib disimpan dalam bentuk hash.
3. User role `voter` hanya bisa voting satu kali.
4. User role `admin` tidak bisa voting.
5. Vote tidak bisa diubah setelah disubmit.
6. Voting hanya bisa dilakukan ketika `settings.voting_status = open`.
7. Voting hanya bisa dilakukan dalam rentang `voting_start` dan `voting_end`.
8. Kandidat yang tampil ke pemilih hanya kandidat dengan status `verified`.
9. Hasil publik hanya tampil ketika `settings.result_visibility = true`.
10. Setiap vote harus dicatat ke `votes`.
11. Setiap aktivitas penting disimpan ke `audit_logs`.
12. Nomor urut kandidat harus unik.
13. NPM user harus unik.
14. Foreign key harus menjaga integritas data.

---

# 13. Voting Logic

Gunakan database transaction saat menyimpan vote.

```php
DB::transaction(function () use ($user, $candidate) {
    if ($user->has_voted || Vote::where('user_id', $user->id)->exists()) {
        throw new Exception('Anda sudah melakukan voting.');
    }

    Vote::create([
        'user_id' => $user->id,
        'candidate_id' => $candidate->id,
        'voted_at' => now(),
    ]);

    $user->update([
        'has_voted' => true,
    ]);
});
```

Alasan memakai transaction:

- Mencegah vote tersimpan tetapi status user gagal update.
- Mencegah data tidak konsisten.
- Memperkuat validasi anti duplicate voting.

---

# 14. Setup Project

## 14.1 Install Laravel

```bash
composer create-project laravel/laravel bem-evoting
cd bem-evoting
```

## 14.2 Setup Environment

Ubah `.env`:

```env
APP_NAME="BEM E-Voting"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=evoting_bem
DB_USERNAME=root
DB_PASSWORD=
```

## 14.3 Jalankan Migration

```bash
php artisan migrate
```

## 14.4 Jalankan Seeder

```bash
php artisan db:seed
```

## 14.5 Jalankan Server

```bash
php artisan serve
```

---

# 15. Data Seeder Awal

Seeder minimal:

```php
Setting::create([
    'app_name' => 'BEM E-Voting',
    'election_title' => 'Pemilihan Umum BEM 2026',
    'voting_status' => 'closed',
    'result_visibility' => false,
]);

User::create([
    'npm' => 'admin001',
    'name' => 'FARU',
    'pin' => Hash::make('123456'),
    'role' => 'admin',
    'has_voted' => false,
    'is_active' => true,
]);
```

Login admin default:

```text
NPM: admin001
PIN: 123456
```

---

# 16. MVP Scope

Fitur wajib MVP:

- Login NPM dan PIN.
- Dashboard pemilih.
- Detail kandidat.
- Submit voting.
- Anti duplicate vote.
- Hasil voting publik.
- Admin dashboard.
- CRUD pemilih.
- CRUD kandidat.
- Pengaturan voting.
- Pengaturan publikasi hasil.
- Struktur database lengkap.

Fitur opsional:

- Import Excel pemilih.
- Export hasil PDF.
- Realtime websocket.
- OTP login.
- QR code voting.
- Multi election.

---

# 17. Catatan Keamanan

- Jangan simpan PIN dalam bentuk plaintext.
- Gunakan `Hash::make()` untuk menyimpan PIN.
- Gunakan `Hash::check()` untuk validasi PIN.
- Aktifkan CSRF protection.
- Gunakan middleware role.
- Gunakan rate limiter pada login.
- Gunakan HTTPS di production.
- Validasi file upload foto kandidat.
- Batasi akses route admin hanya untuk role admin.
- Gunakan transaction saat submit vote.

---

# 18. Kesimpulan

README ini menjelaskan rancangan sistem BEM E-Voting berbasis Laravel, mencakup fitur, desain, role pengguna, struktur database, relasi tabel, migration, route, business rules, dan setup awal project.

Struktur database dirancang agar aman untuk proses e-voting, terutama dengan kombinasi:

- `users.has_voted`
- unique constraint pada `votes.user_id`
- database transaction saat submit vote
- audit log untuk aktivitas penting

Dengan struktur ini, sistem dapat dikembangkan menjadi aplikasi e-voting kampus yang aman, modern, dan mudah dikelola.
