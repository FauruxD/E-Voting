````md
# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# BEM E-VOTING SYSTEM

---

# 1. PROJECT OVERVIEW

## Nama Project
BEM E-Voting System

## Jenis Aplikasi
Web Application (Responsive)

## Tujuan Sistem
Membangun platform pemilihan umum BEM berbasis digital yang:
- Aman
- Transparan
- Real-time
- Modern
- Mudah digunakan

Sistem memungkinkan mahasiswa melakukan voting online dengan pengalaman UI modern dark mode serta admin dapat mengelola seluruh proses pemilu.

---

# 2. PRODUCT GOALS

## Goals Utama
- Digitalisasi pemilu kampus
- Mengurangi kecurangan voting
- Mempermudah mahasiswa memilih
- Menampilkan hasil realtime
- Memudahkan panitia mengelola pemilu

## Success Metrics
| Metric | Target |
|---|---|
| Uptime | 99% |
| Response Time | < 2 detik |
| Duplicate Vote | 0 |
| Participation Rate | > 80% |
| Concurrent Users | 5000+ |

---

# 3. USER ROLES

## 1. Pemilih (Mahasiswa)
Hak akses:
- Login menggunakan NPM dan PIN
- Melihat kandidat
- Melihat visi misi
- Melakukan voting
- Melihat hasil voting

## 2. Admin / Panitia
Hak akses:
- Kelola kandidat
- Kelola pemilih
- Monitoring voting
- Pengaturan sistem
- Publish hasil voting

---

# 4. DESIGN SYSTEM

---

# 4.1 Design Direction

## Style
- Modern Dark Dashboard
- Glassmorphism
- Minimalis
- Premium
- Smooth animation
- Clean spacing
- Rounded corner UI

## Inspiration
- Modern SaaS Dashboard
- Apple-like clean layout
- Neo-dark interface
- Elegant election system

---

# 4.2 Theme & Color Palette

## Primary Colors
| Element | Color |
|---|---|
| Background | #0D0D0D |
| Card Background | #161616 |
| Border | #2A2A2A |
| Accent Primary | #E8F06A |
| Accent Hover | #DCE850 |
| Text Primary | #FFFFFF |
| Text Secondary | #A0A0A0 |
| Success | #22C55E |
| Danger | #EF4444 |
| Warning | #F59E0B |

---

# 4.3 Typography

## Font Family
- Poppins
- Inter

## Font Weight
| Usage | Weight |
|---|---|
| Heading | 700 |
| Subheading | 600 |
| Body | 400 |
| Caption | 300 |

---

# 4.4 UI Components

## Components
- Navbar
- Sidebar
- Candidate Card
- Stats Card
- Table
- Modal
- Button
- Input
- Progress Bar
- Countdown Timer
- Toast Notification
- Badge
- Tooltip

## Border Radius
- 16px
- 20px
- 24px

## Shadow
```css
box-shadow: 0 0 30px rgba(232, 240, 106, 0.08);
````

---

# 4.5 Animation

## Animation Library

* Framer Motion

## Animation Usage

* Page transition
* Hover card effect
* Fade in
* Slide up
* Button interaction
* Skeleton loading

---

# 5. FRONTEND FEATURES

---

# 5.1 LOGIN PAGE

## Features

* Login menggunakan NPM
* Login menggunakan PIN
* Remember me
* Show/Hide PIN
* Validation
* Session login

## Validation

* NPM wajib unik
* PIN minimal 6 digit
* Maksimal 5x login gagal

## UI Elements

* Centered login card
* Dark background glow
* Neon button
* Soft shadow

## API

```http
POST /api/auth/login
```

---

# 5.2 USER DASHBOARD

## Features

* List kandidat
* Countdown voting
* Informasi singkat kandidat
* Tombol pilih kandidat
* Status voting user

## Rules

* Satu user hanya bisa voting sekali
* Voting tidak dapat diubah
* Timer realtime

## Components

* Navbar
* Candidate Grid
* Countdown Box
* Footer

---

# 5.3 DETAIL KANDIDAT

## Features

* Foto kandidat
* Biodata
* Fakultas
* Jurusan
* Angkatan
* Visi
* Misi
* Program kerja

## Voting Flow

1. User membuka kandidat
2. User membaca detail
3. Klik tombol konfirmasi
4. Modal konfirmasi muncul
5. Submit voting
6. Vote tersimpan permanen

---

# 5.4 REALTIME RESULT PAGE

## Features

* Persentase voting
* Progress bar
* Total suara
* Tingkat partisipasi
* Total DPT
* Last updated realtime

## Realtime

* Polling 30 detik
* Optional websocket

## Visibility

* Bisa dibuka/tutup admin

---

# 6. ADMIN PANEL

---

# 6.1 ADMIN DASHBOARD

## Features

* Statistik voting
* Total pemilih
* Sudah memilih
* Belum memilih
* Tingkat partisipasi
* Grafik voting realtime

---

# 6.2 MANAJEMEN PEMILIH

## Features

* Tambah pemilih
* Edit pemilih
* Hapus pemilih
* Import Excel
* Search pemilih
* Filter status voting

## Data Fields

| Field         | Type    |
| ------------- | ------- |
| NPM           | String  |
| Nama          | String  |
| Fakultas      | String  |
| Jurusan       | String  |
| PIN           | String  |
| Status Voting | Boolean |

## Rules

* NPM unik
* Tidak boleh duplicate

---

# 6.3 MANAJEMEN KANDIDAT

## Features

* Tambah kandidat
* Upload foto
* Edit kandidat
* Hapus kandidat
* Status verifikasi

## Candidate Fields

| Field         | Type    |
| ------------- | ------- |
| Nomor Urut    | Integer |
| Nama Ketua    | String  |
| Nama Wakil    | String  |
| Fakultas      | String  |
| Jurusan       | String  |
| Visi          | Text    |
| Misi          | Text    |
| Program Kerja | Text    |
| Foto          | Image   |

---

# 6.4 ADMIN RESULT PAGE

## Features

* Grafik hasil voting
* Persentase suara
* Statistik voting
* Last updated
* Export PDF

## Charts

* Bar chart
* Pie chart
* Participation chart

---

# 6.5 SYSTEM SETTINGS

## Features

* Buka/Tutup voting
* Publish hasil
* Atur jadwal voting
* Reset voting

## Permissions

* Super admin only

---

# 7. NON FUNCTIONAL REQUIREMENTS

---

# 7.1 Security

## Requirements

* HTTPS
* JWT Authentication
* Password Hashing (bcrypt)
* CSRF Protection
* SQL Injection Protection
* Rate Limiting
* Audit Logging

## Voting Security

* One device one session
* Vote immutable
* Encrypted transaction

---

# 7.2 Performance

## Requirements

| Requirement      | Target  |
| ---------------- | ------- |
| Load Time        | < 2 sec |
| Concurrent Users | 5000+   |
| Lighthouse Score | 90+     |
| API Response     | < 500ms |

---

# 7.3 Scalability

## Requirements

* Horizontal scaling
* Redis cache
* Queue system
* CDN assets

---

# 8. TECH STACK

---

# 8.1 Frontend

## Stack

* Next.js 15
* React
* TailwindCSS
* Shadcn UI
* Framer Motion
* Lucide Icons

---

# 8.2 Backend

## Option 1

* Laravel 11

## Option 2

* NestJS

## Option 3

* ExpressJS

---

# 8.3 Database

## Main Database

* PostgreSQL

## Cache

* Redis

---

# 8.4 Deployment

## Frontend

* Vercel

## Backend

* VPS / Railway / Render

## Database

* Supabase / NeonDB

---

# 9. DATABASE STRUCTURE

---

# users

```sql
id
npm
name
pin
role
faculty
major
has_voted
created_at
updated_at
```

---

# candidates

```sql
id
nomor_urut
ketua
wakil
faculty
major
visi
misi
program_kerja
foto
status
created_at
updated_at
```

---

# votes

```sql
id
user_id
candidate_id
voted_at
```

---

# settings

```sql
id
voting_status
result_visibility
voting_start
voting_end
updated_at
```

---

# audit_logs

```sql
id
user_id
action
ip_address
created_at
```

---

# 10. API ENDPOINTS

---

# Authentication

```http
POST /api/auth/login
POST /api/auth/logout
GET /api/auth/me
```

---

# Candidates

```http
GET /api/candidates
GET /api/candidates/:id
POST /api/admin/candidates
PUT /api/admin/candidates/:id
DELETE /api/admin/candidates/:id
```

---

# Voting

```http
POST /api/vote
GET /api/results
GET /api/statistics
```

---

# Users

```http
GET /api/admin/users
POST /api/admin/users
PUT /api/admin/users/:id
DELETE /api/admin/users/:id
```

---

# Settings

```http
GET /api/admin/settings
PATCH /api/admin/settings
```

---

# 11. USER FLOW

---

# Pemilih Flow

```text
Login
→ Dashboard
→ Pilih Kandidat
→ Detail Kandidat
→ Konfirmasi
→ Vote Success
→ Logout
```

---

# Admin Flow

```text
Login Admin
→ Dashboard
→ Kelola Kandidat
→ Kelola Pemilih
→ Buka Voting
→ Monitoring Hasil
→ Logout
```

---

# 12. RESPONSIVE DESIGN

## Desktop

* Full dashboard layout

## Tablet

* Collapsible sidebar

## Mobile

* Bottom navigation
* Single column card
* Mobile optimized voting flow

---

# 13. ACCESSIBILITY

## Requirements

* Keyboard navigation
* High contrast
* Screen reader support
* Focus states

---

# 14. FUTURE ENHANCEMENT

## Phase 2 Features

* OTP verification
* QR Code voting
* Face verification
* Blockchain verification
* Multi election support
* Mobile apps
* Live websocket
* AI fraud detection

---

# 15. DEVELOPMENT TIMELINE

| Phase                | Duration |
| -------------------- | -------- |
| UI/UX Design         | 1 minggu |
| Frontend Development | 2 minggu |
| Backend Development  | 2 minggu |
| Integration          | 1 minggu |
| Testing              | 1 minggu |
| Deployment           | 3 hari   |

---

# 16. MVP FEATURES

## WAJIB

* Login
* Voting
* Kandidat
* Admin dashboard
* Hasil realtime
* Pengaturan voting

## OPTIONAL

* Export PDF
* Realtime websocket
* Analytics chart
* Email notification

---

# 17. FINAL CONCLUSION

BEM E-Voting adalah sistem pemilu digital modern dengan:

* UI premium dark mode,
* realtime voting,
* keamanan tinggi,
* admin panel lengkap,
* serta pengalaman pengguna yang modern dan responsif.

Sistem dirancang untuk mendukung pemilu kampus berskala besar dengan performa tinggi dan tampilan profesional.

```
```
