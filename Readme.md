# PRD & Technical Specification
# BEM E-Voting System — Laravel

## 1. Ringkasan Project

**Nama Sistem:** BEM E-Voting System  
**Framework:** Laravel  
**Jenis Aplikasi:** Web Application  
**Target Pengguna:** Mahasiswa sebagai pemilih dan admin/panitia sebagai pengelola pemilihan.

Sistem ini dibuat untuk mendigitalisasi proses pemilihan umum BEM kampus dengan tampilan modern dark mode, proses voting yang aman, serta dashboard admin untuk mengelola kandidat, pemilih, hasil suara, dan konfigurasi pemilihan.

---

## 2. Tujuan Sistem

Sistem E-Voting ini bertujuan untuk:

- Memudahkan mahasiswa melakukan voting secara online.
- Mencegah pemilih melakukan voting lebih dari satu kali.
- Memudahkan admin mengelola data kandidat dan pemilih.
- Menampilkan hasil voting secara real-time atau berkala.
- Menyediakan sistem pemilu digital yang aman, rapi, dan mudah digunakan.

---

## 3. Role Pengguna

## 3.1 Pemilih / Mahasiswa

Pemilih adalah mahasiswa yang terdaftar dalam Daftar Pemilih Tetap.

Hak akses pemilih:

- Login menggunakan NPM dan PIN.
- Melihat daftar pasangan calon.
- Melihat detail kandidat.
- Melakukan voting satu kali.
- Melihat hasil pemilihan jika hasil dibuka oleh admin.
- Logout dari sistem.

## 3.2 Admin / Panitia

Admin adalah pengguna yang bertugas mengelola sistem pemilihan.

Hak akses admin:

- Login ke dashboard admin.
- Melihat ringkasan statistik pemilihan.
- Mengelola data pemilih.
- Mengelola data kandidat.
- Melihat hasil suara.
- Membuka atau menutup voting.
- Mengatur publikasi hasil.
- Logout dari sistem.

---

## 4. Design System

## 4.1 Tema Visual

Tema utama sistem mengikuti desain modern dark mode dengan aksen warna kuning neon.

Karakter desain:

- Dark mode.
- Modern dashboard.
- Minimalis.
- Rounded card.
- Soft shadow.
- Glassmorphism pada halaman login.
- Layout bersih dan mudah dipahami.
- Warna aksen kuning untuk tombol aktif, highlight, dan status penting.

## 4.2 Color Palette

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

## 4.3 Typography

Font yang disarankan:

- `Poppins`
- `Inter`

Penggunaan font:

| Elemen | Weight |
|---|---|
| Heading | 700 |
| Subheading | 600 |
| Body | 400 |
| Caption | 300 |

## 4.4 Komponen UI

Komponen yang dibutuhkan:

- Navbar
- Sidebar admin
- Login card
- Candidate card
- Detail candidate section
- Button primary
- Button danger
- Input field
- Badge status
- Table
- Progress bar
- Countdown timer
- Modal confirmation
- Toast notification
- Stats card
- Footer

## 4.5 Responsive Design

Desktop:

- Layout lebar penuh.
- Sidebar admin tetap tampil.
- Candidate card menggunakan grid 3 kolom.

Tablet:

- Sidebar dapat dibuat collapsible.
- Candidate card 2 kolom.

Mobile:

- Candidate card 1 kolom.
- Navbar disederhanakan.
- Button besar dan mudah ditekan.
- Admin dashboard tetap dapat digunakan secara responsive.

---

## 5. Fitur Frontend Pemilih

## 5.1 Login Pemilih

Halaman login digunakan oleh mahasiswa untuk masuk ke sistem menggunakan NPM dan PIN.

Fitur:

- Input NPM.
- Input PIN.
- Show/hide PIN.
- Remember me.
- Validasi form.
- Error message jika data salah.
- Redirect ke halaman daftar kandidat jika login berhasil.

Rules:

- NPM wajib diisi.
- PIN wajib diisi.
- NPM harus terdaftar.
- PIN harus sesuai.
- User yang tidak aktif tidak bisa login.
- Maksimal percobaan login dapat dibatasi menggunakan Laravel Rate Limiter.

Route:

```php
GET  /login
POST /login
POST /logout
```

Controller:

```php
AuthController@loginPage
AuthController@login
AuthController@logout
```

---

## 5.2 Halaman Daftar Paslon

Halaman ini menampilkan seluruh pasangan calon yang tersedia.

Fitur:

- Menampilkan daftar kandidat.
- Menampilkan nomor urut kandidat.
- Menampilkan nama ketua dan wakil.
- Menampilkan ringkasan visi.
- Menampilkan tombol “Pilih Paslon Ini”.
- Menampilkan countdown waktu voting.
- Menampilkan informasi bahwa suara tidak dapat diubah.

Rules:

- Jika voting belum dibuka, tombol voting disabled.
- Jika voting sudah ditutup, tombol voting disabled.
- Jika user sudah memilih, tombol voting disabled.
- User hanya dapat memilih satu kali.

Route:

```php
GET /dashboard
```

Controller:

```php
VotingController@index
```

---

## 5.3 Halaman Detail Kandidat

Halaman ini menampilkan informasi lengkap kandidat sebelum pemilih memberikan suara.

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
- Program kerja unggulan.
- Tombol konfirmasi voting.

Rules:

- User wajib membaca detail kandidat sebelum memilih.
- Setelah memilih, suara tidak bisa diubah.
- Sistem menampilkan modal konfirmasi sebelum submit.

Route:

```php
GET /candidates/{candidate}
```

Controller:

```php
CandidatePublicController@show
```

---

## 5.4 Submit Voting

Fitur ini digunakan untuk menyimpan suara pemilih.

Rules utama:

- Satu user hanya boleh memiliki satu vote.
- Jika user sudah memilih, sistem menolak request berikutnya.
- Voting hanya dapat dilakukan saat status voting aktif.
- Voting hanya dapat dilakukan dalam rentang waktu voting.
- Setelah voting berhasil, field `has_voted` pada user berubah menjadi `true`.

Route:

```php
POST /vote/{candidate}
```

Controller:

```php
VotingController@store
```

Validasi backend wajib:

```php
- user harus login
- user belum pernah voting
- kandidat harus valid
- voting_status harus open
- waktu saat ini berada di antara voting_start dan voting_end
```

---

## 5.5 Halaman Hasil Publik

Halaman ini menampilkan hasil voting kepada pemilih jika admin mengaktifkan publikasi hasil.

Fitur:

- Total suara masuk.
- Total DPT.
- Tingkat partisipasi.
- Persentase suara setiap kandidat.
- Progress bar setiap kandidat.
- Data diperbarui berkala.

Rules:

- Jika `result_visibility = false`, halaman hasil tidak dapat diakses publik.
- Jika hasil disembunyikan, tampilkan pesan “Hasil belum dipublikasikan”.

Route:

```php
GET /results
```

Controller:

```php
ResultController@public
```

---

## 6. Fitur Admin Panel

## 6.1 Dashboard Admin

Dashboard admin menampilkan ringkasan pemilihan.

Fitur:

- Total DPT.
- Total suara masuk.
- Total belum memilih.
- Tingkat partisipasi.
- Ringkasan hasil suara.
- Status voting saat ini.

Route:

```php
GET /admin/dashboard
```

Controller:

```php
Admin/DashboardController@index
```

---

## 6.2 Manajemen Pemilih

Admin dapat mengelola data pemilih tetap.

Fitur:

- Melihat daftar pemilih.
- Search pemilih berdasarkan nama atau NPM.
- Tambah pemilih.
- Edit pemilih.
- Hapus pemilih.
- Melihat status sudah/belum memilih.
- Import data pemilih dari Excel atau CSV.
- Generate PIN pemilih.

Data pemilih:

| Field | Tipe |
|---|---|
| id | bigint |
| npm | string unique |
| name | string |
| faculty | string |
| major | string |
| pin | string hashed |
| role | enum |
| has_voted | boolean |
| is_active | boolean |
| created_at | timestamp |
| updated_at | timestamp |

Route:

```php
GET    /admin/voters
GET    /admin/voters/create
POST   /admin/voters
GET    /admin/voters/{user}/edit
PUT    /admin/voters/{user}
DELETE /admin/voters/{user}
POST   /admin/voters/import
```

Controller:

```php
Admin/VoterController
```

---

## 6.3 Manajemen Kandidat

Admin dapat mengelola pasangan calon.

Fitur:

- Melihat daftar kandidat.
- Tambah kandidat.
- Edit kandidat.
- Hapus kandidat.
- Upload foto kandidat.
- Menentukan nomor urut.
- Mengatur status kandidat: verified atau pending.
- Mengisi visi, misi, dan program kerja.

Data kandidat:

| Field | Tipe |
|---|---|
| id | bigint |
| serial_number | integer unique |
| chairman_name | string |
| vice_name | string |
| faculty | string |
| major | string |
| batch | string nullable |
| vision | text |
| mission | longText |
| work_programs | json |
| photo | string nullable |
| status | enum |
| created_at | timestamp |
| updated_at | timestamp |

Route:

```php
GET    /admin/candidates
GET    /admin/candidates/create
POST   /admin/candidates
GET    /admin/candidates/{candidate}/edit
PUT    /admin/candidates/{candidate}
DELETE /admin/candidates/{candidate}
```

Controller:

```php
Admin/CandidateController
```

---

## 6.4 Hasil Voting Admin

Admin dapat melihat hasil voting secara lengkap.

Fitur:

- Total suara masuk.
- Total pemilih terdaftar.
- Tingkat partisipasi.
- Jumlah suara tiap kandidat.
- Persentase suara tiap kandidat.
- Progress bar hasil.
- Timestamp terakhir diperbarui.
- Export hasil ke PDF.

Route:

```php
GET /admin/results
GET /admin/results/export
```

Controller:

```php
Admin/ResultController@index
Admin/ResultController@export
```

---

## 6.5 Pengaturan Sistem

Admin dapat mengatur konfigurasi sistem voting.

Fitur:

- Buka voting.
- Tutup voting.
- Tampilkan hasil ke publik.
- Sembunyikan hasil dari publik.
- Atur tanggal mulai voting.
- Atur tanggal selesai voting.
- Simpan perubahan konfigurasi.

Data setting:

| Field | Tipe |
|---|---|
| id | bigint |
| voting_status | enum: open, closed |
| result_visibility | boolean |
| voting_start | datetime |
| voting_end | datetime |
| app_name | string |
| election_title | string |
| created_at | timestamp |
| updated_at | timestamp |

Route:

```php
GET   /admin/settings
PATCH /admin/settings
```

Controller:

```php
Admin/SettingController
```

---

## 7. Struktur Database Laravel

## 7.1 Tabel users

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
});
```

## 7.2 Tabel candidates

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
});
```

## 7.3 Tabel votes

```php
Schema::create('votes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
    $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
    $table->timestamp('voted_at');
    $table->timestamps();
});
```

## 7.4 Tabel settings

```php
Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('app_name')->default('BEM E-Voting');
    $table->string('election_title')->default('Pemilihan Umum BEM');
    $table->enum('voting_status', ['open', 'closed'])->default('closed');
    $table->boolean('result_visibility')->default(false);
    $table->dateTime('voting_start')->nullable();
    $table->dateTime('voting_end')->nullable();
    $table->timestamps();
});
```

## 7.5 Tabel audit_logs

```php
Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
    $table->string('action');
    $table->string('ip_address')->nullable();
    $table->text('user_agent')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamps();
});
```

---

## 8. Model & Relationship Laravel

## 8.1 User Model

```php
class User extends Authenticatable
{
    protected $fillable = [
        'npm',
        'name',
        'faculty',
        'major',
        'pin',
        'role',
        'has_voted',
        'is_active',
    ];

    protected $hidden = [
        'pin',
        'remember_token',
    ];

    protected $casts = [
        'has_voted' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
```

## 8.2 Candidate Model

```php
class Candidate extends Model
{
    protected $fillable = [
        'serial_number',
        'chairman_name',
        'vice_name',
        'faculty',
        'major',
        'batch',
        'vision',
        'mission',
        'work_programs',
        'photo',
        'status',
    ];

    protected $casts = [
        'work_programs' => 'array',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
```

## 8.3 Vote Model

```php
class Vote extends Model
{
    protected $fillable = [
        'user_id',
        'candidate_id',
        'voted_at',
    ];

    protected $casts = [
        'voted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
```

---

## 9. Route Structure

## 9.1 Web Routes

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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/voters', AdminVoterController::class);
        Route::post('/voters/import', [AdminVoterController::class, 'import'])->name('voters.import');
        Route::resource('/candidates', AdminCandidateController::class);
        Route::get('/results', [AdminResultController::class, 'index'])->name('results.index');
        Route::get('/results/export', [AdminResultController::class, 'export'])->name('results.export');
        Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
```

---

## 10. Middleware

## 10.1 Auth Middleware

Menggunakan middleware bawaan Laravel:

```php
auth
```

## 10.2 Role Middleware

Middleware custom untuk membedakan admin dan pemilih.

```php
php artisan make:middleware RoleMiddleware
```

Logic:

```php
public function handle($request, Closure $next, $role)
{
    if (!auth()->check() || auth()->user()->role !== $role) {
        abort(403);
    }

    return $next($request);
}
```

## 10.3 Prevent Duplicate Vote

Validasi duplicate vote dilakukan pada controller dan database.

Lapisan keamanan:

- Field `has_voted` pada users.
- Unique constraint `user_id` pada votes.
- Database transaction saat submit vote.

---

## 11. Voting Logic

Voting harus menggunakan database transaction agar data tetap konsisten.

Contoh logic:

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

---

## 12. Authentication Requirement

Karena login menggunakan NPM dan PIN, Laravel default auth perlu disesuaikan.

## 12.1 Login Field

Login menggunakan:

```text
npm
pin
```

Bukan:

```text
email
password
```

## 12.2 Hash PIN

PIN tetap harus di-hash seperti password.

```php
Hash::make($request->pin)
```

Cek PIN:

```php
Hash::check($request->pin, $user->pin)
```

---

## 13. Security Requirements

Keamanan wajib:

- PIN disimpan dalam bentuk hash.
- HTTPS pada production.
- CSRF protection aktif.
- Rate limiter untuk login.
- Validasi semua input.
- Authorization admin dan voter dipisah.
- Vote tidak boleh bisa diedit atau dihapus oleh pemilih.
- Gunakan database transaction saat voting.
- Gunakan audit log untuk aktivitas penting.
- File upload foto kandidat harus divalidasi.
- Admin route wajib dilindungi middleware admin.

## 13.1 Rate Limiting Login

Batasi percobaan login:

```php
RateLimiter::attempt(
    'login:'.$request->ip(),
    $perMinute = 5,
    function () {
        // attempt login
    }
);
```

## 13.2 File Upload Security

Validasi foto kandidat:

```php
'image|mimes:jpg,jpeg,png,webp|max:2048'
```

---

## 14. API / AJAX Endpoint Opsional

Jika hasil voting ingin realtime tanpa reload halaman, dapat menggunakan endpoint JSON.

```php
GET /api/results
GET /api/stats
```

Response example:

```json
{
  "total_voters": 1500,
  "total_votes": 1248,
  "participation": 83.2,
  "candidates": [
    {
      "serial_number": 1,
      "name": "Rizky Maulana & Siti Nur Aisyah",
      "votes": 501,
      "percentage": 40.1
    }
  ]
}
```

---

## 15. Recommended Laravel Packages

Paket yang disarankan:

- `laravel/breeze` untuk starter auth, bisa dimodifikasi NPM + PIN.
- `maatwebsite/excel` untuk import data pemilih.
- `barryvdh/laravel-dompdf` untuk export PDF.
- `spatie/laravel-permission` opsional untuk role permission yang lebih kompleks.
- `intervention/image` opsional untuk optimasi foto kandidat.

Install example:

```bash
composer require maatwebsite/excel
composer require barryvdh/laravel-dompdf
```

---

## 16. Frontend Implementation di Laravel

## 16.1 Pilihan Frontend

Rekomendasi paling cocok:

```text
Laravel Blade + TailwindCSS + Alpine.js
```

Alasan:

- Mudah untuk project kampus.
- Tidak perlu frontend terpisah.
- Cepat dikembangkan.
- Cocok untuk dashboard admin.
- Tetap bisa modern dengan Tailwind.

Alternatif:

```text
Laravel + Inertia.js + React
```

Cocok jika ingin UI lebih interaktif, tetapi setup lebih kompleks.

## 16.2 Struktur View

```text
resources/views/
├── layouts/
│   ├── app.blade.php
│   └── admin.blade.php
├── auth/
│   └── login.blade.php
├── voter/
│   ├── dashboard.blade.php
│   ├── candidate-detail.blade.php
│   └── results.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── voters/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── candidates/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── results.blade.php
    └── settings.blade.php
```

## 16.3 Tailwind Setup

```bash
npm install
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
npm run dev
```

---

## 17. Folder Structure Laravel

Struktur yang disarankan:

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

## 18. Controller Responsibility

## 18.1 AuthController

Tanggung jawab:

- Menampilkan halaman login.
- Memvalidasi NPM dan PIN.
- Membuat session login.
- Logout user.
- Redirect berdasarkan role.

## 18.2 VotingController

Tanggung jawab:

- Menampilkan daftar kandidat.
- Mengecek status voting.
- Menyimpan suara.
- Mencegah duplicate vote.

## 18.3 CandidatePublicController

Tanggung jawab:

- Menampilkan detail kandidat ke pemilih.

## 18.4 ResultController

Tanggung jawab:

- Menampilkan hasil publik.
- Mengecek visibility hasil.

## 18.5 Admin Controllers

Tanggung jawab:

- CRUD pemilih.
- CRUD kandidat.
- Statistik hasil.
- Pengaturan sistem.

---

## 19. Business Rules

Rules utama sistem:

1. Pemilih hanya bisa login jika NPM dan PIN valid.
2. Pemilih hanya dapat voting satu kali.
3. Voting tidak dapat diubah.
4. Voting hanya dapat dilakukan ketika status voting `open`.
5. Voting hanya dapat dilakukan dalam jadwal yang ditentukan.
6. Admin tidak boleh melakukan voting kecuali memiliki akun voter terpisah.
7. Hasil publik hanya tampil jika admin mengaktifkan publikasi.
8. Kandidat pending tidak tampil di halaman pemilih.
9. NPM pemilih harus unik.
10. Nomor urut kandidat harus unik.
11. Suara tidak boleh dihapus melalui panel pemilih.
12. Semua aktivitas penting dicatat ke audit log.

---

## 20. Validation Rules

## 20.1 Login

```php
'npm' => ['required', 'string'],
'pin' => ['required', 'string', 'min:6']
```

## 20.2 Voter

```php
'npm' => ['required', 'string', 'unique:users,npm'],
'name' => ['required', 'string', 'max:255'],
'faculty' => ['nullable', 'string'],
'major' => ['nullable', 'string'],
'pin' => ['required', 'string', 'min:6'],
'is_active' => ['boolean']
```

## 20.3 Candidate

```php
'serial_number' => ['required', 'integer', 'unique:candidates,serial_number'],
'chairman_name' => ['required', 'string', 'max:255'],
'vice_name' => ['required', 'string', 'max:255'],
'faculty' => ['nullable', 'string'],
'major' => ['nullable', 'string'],
'vision' => ['required', 'string'],
'mission' => ['required', 'string'],
'work_programs' => ['nullable', 'array'],
'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
'status' => ['required', 'in:verified,pending']
```

## 20.4 Settings

```php
'voting_status' => ['required', 'in:open,closed'],
'result_visibility' => ['required', 'boolean'],
'voting_start' => ['nullable', 'date'],
'voting_end' => ['nullable', 'date', 'after:voting_start'],
'election_title' => ['required', 'string', 'max:255']
```

---

## 21. Page List

## 21.1 Public / Voter Pages

| Page | Route |
|---|---|
| Login | `/login` |
| Daftar Paslon | `/dashboard` |
| Detail Paslon | `/candidates/{id}` |
| Hasil Voting | `/results` |

## 21.2 Admin Pages

| Page | Route |
|---|---|
| Admin Dashboard | `/admin/dashboard` |
| Manajemen Pemilih | `/admin/voters` |
| Tambah Pemilih | `/admin/voters/create` |
| Edit Pemilih | `/admin/voters/{id}/edit` |
| Manajemen Kandidat | `/admin/candidates` |
| Tambah Kandidat | `/admin/candidates/create` |
| Edit Kandidat | `/admin/candidates/{id}/edit` |
| Hasil Voting Admin | `/admin/results` |
| Pengaturan Sistem | `/admin/settings` |

---

## 22. Testing Plan

## 22.1 Feature Test

Test yang wajib dibuat:

- User dapat login dengan NPM dan PIN valid.
- User tidak dapat login dengan PIN salah.
- User dapat melihat daftar kandidat.
- User dapat voting saat voting dibuka.
- User tidak dapat voting dua kali.
- User tidak dapat voting saat voting ditutup.
- Admin dapat CRUD kandidat.
- Admin dapat CRUD pemilih.
- Admin dapat membuka dan menutup voting.
- Hasil publik hanya muncul jika visibility aktif.

## 22.2 Unit Test

- Perhitungan persentase suara.
- Perhitungan tingkat partisipasi.
- Validasi status voting.
- Validasi duplicate vote.

---

## 23. Deployment Requirement

## 23.1 Server Requirement

- PHP 8.2+
- Composer
- MySQL 8 / PostgreSQL
- Node.js 18+
- Nginx / Apache
- SSL certificate

## 23.2 Environment

Contoh `.env`:

```env
APP_NAME="BEM E-Voting"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://evoting.example.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=evoting_bem
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=database
```

## 23.3 Deployment Commands

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 24. MVP Scope

Fitur wajib untuk versi pertama:

- Login NPM dan PIN.
- Dashboard pemilih.
- Detail kandidat.
- Submit voting.
- Cegah voting ganda.
- Hasil voting.
- Admin dashboard.
- CRUD pemilih.
- CRUD kandidat.
- Pengaturan buka/tutup voting.
- Pengaturan publikasi hasil.

Fitur opsional:

- Import Excel pemilih.
- Export PDF hasil.
- Websocket realtime.
- Email notification.
- QR code voter.
- OTP login.

---

## 25. Development Timeline

| Tahap | Estimasi |
|---|---|
| Setup Laravel project | 1 hari |
| Database migration & model | 1–2 hari |
| Auth NPM + PIN | 1 hari |
| Frontend pemilih | 3–4 hari |
| Voting logic | 1–2 hari |
| Admin dashboard | 2 hari |
| CRUD pemilih | 2 hari |
| CRUD kandidat | 2 hari |
| Hasil voting | 1–2 hari |
| Settings sistem | 1 hari |
| Testing & bug fixing | 3–5 hari |
| Deployment | 1 hari |

Estimasi total MVP: **2–4 minggu**.

---

## 26. Kesimpulan

Sistem BEM E-Voting berbasis Laravel ini dirancang untuk menjadi platform pemilihan digital yang aman, modern, dan mudah digunakan.

Dengan Laravel sebagai backend utama, sistem akan memiliki struktur yang rapi, keamanan yang kuat, serta mudah dikembangkan ke fitur lanjutan seperti import Excel, export PDF, realtime websocket, OTP, dan multi-election support.

Fokus utama MVP adalah memastikan proses voting berjalan aman, tidak ada duplicate vote, admin mudah mengelola data, dan hasil voting dapat dipantau dengan jelas.
