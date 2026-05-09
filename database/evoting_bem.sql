CREATE DATABASE IF NOT EXISTS evoting_bem
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE evoting_bem;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS audit_logs;
DROP TABLE IF EXISTS votes;
DROP TABLE IF EXISTS candidates;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS failed_jobs;
DROP TABLE IF EXISTS job_batches;
DROP TABLE IF EXISTS jobs;
DROP TABLE IF EXISTS cache_locks;
DROP TABLE IF EXISTS cache;
DROP TABLE IF EXISTS sessions;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    npm VARCHAR(30) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    jurusan VARCHAR(255) NULL,
    prodi VARCHAR(255) NULL,
    pin VARCHAR(255) NOT NULL,
    peran ENUM('voter', 'admin') NOT NULL DEFAULT 'voter',
    sudah_memilih BOOLEAN NOT NULL DEFAULT FALSE,
    aktif BOOLEAN NOT NULL DEFAULT TRUE,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_users_peran (peran),
    INDEX idx_users_sudah_memilih (sudah_memilih),
    INDEX idx_users_aktif (aktif)
);

CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

CREATE TABLE cache (
    `key` VARCHAR(255) NOT NULL PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
);

CREATE TABLE cache_locks (
    `key` VARCHAR(255) NOT NULL PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
);

CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INT UNSIGNED NULL,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL,
    INDEX jobs_queue_index (queue)
);

CREATE TABLE job_batches (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INT NOT NULL,
    pending_jobs INT NOT NULL,
    failed_jobs INT NOT NULL,
    failed_job_ids LONGTEXT NOT NULL,
    options MEDIUMTEXT NULL,
    cancelled_at INT NULL,
    created_at INT NOT NULL,
    finished_at INT NULL
);

CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_aplikasi VARCHAR(255) NOT NULL DEFAULT 'BEM E-Voting',
    judul_pemilihan VARCHAR(255) NOT NULL DEFAULT 'Pemilihan Umum BEM 2026',
    status_voting ENUM('open', 'closed') NOT NULL DEFAULT 'closed',
    hasil_ditampilkan BOOLEAN NOT NULL DEFAULT FALSE,
    mulai_voting DATETIME NULL,
    selesai_voting DATETIME NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE candidates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomor_urut INT NOT NULL UNIQUE,
    nama_ketua VARCHAR(255) NOT NULL,
    nama_wakil VARCHAR(255) NOT NULL,
    jurusan VARCHAR(255) NULL,
    prodi VARCHAR(255) NULL,
    angkatan VARCHAR(50) NULL,
    visi TEXT NOT NULL,
    misi LONGTEXT NOT NULL,
    program_kerja JSON NULL,
    foto VARCHAR(255) NULL,
    status ENUM('verified', 'pending') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_candidates_status (status),
    INDEX idx_candidates_nomor_urut (nomor_urut)
);

CREATE TABLE votes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pemilih_id BIGINT UNSIGNED NOT NULL UNIQUE,
    kandidat_id BIGINT UNSIGNED NOT NULL,
    dipilih_pada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_votes_pemilih_id FOREIGN KEY (pemilih_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_votes_kandidat_id FOREIGN KEY (kandidat_id) REFERENCES candidates(id) ON DELETE CASCADE,
    INDEX idx_votes_kandidat_id (kandidat_id),
    INDEX idx_votes_dipilih_pada (dipilih_pada)
);

CREATE TABLE audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pengguna_id BIGINT UNSIGNED NULL,
    aksi VARCHAR(255) NOT NULL,
    alamat_ip VARCHAR(45) NULL,
    agen_pengguna TEXT NULL,
    detail JSON NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_audit_logs_pengguna_id FOREIGN KEY (pengguna_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_audit_logs_pengguna_id (pengguna_id),
    INDEX idx_audit_logs_aksi (aksi),
    INDEX idx_audit_logs_created_at (created_at)
);

INSERT INTO settings (
    nama_aplikasi,
    judul_pemilihan,
    status_voting,
    hasil_ditampilkan,
    mulai_voting,
    selesai_voting,
    created_at,
    updated_at
) VALUES (
    'BEM E-Voting',
    'Pemilihan Umum BEM 2026',
    'open',
    TRUE,
    DATE_SUB(NOW(), INTERVAL 1 DAY),
    DATE_ADD(NOW(), INTERVAL 1 DAY),
    NOW(),
    NOW()
);

INSERT INTO users (
    npm,
    nama,
    jurusan,
    prodi,
    pin,
    peran,
    sudah_memilih,
    aktif,
    created_at,
    updated_at
) VALUES
('admin001', 'FARU', NULL, NULL, '123456', 'admin', FALSE, TRUE, NOW(), NOW()),
('210101', 'Budi Santoso', 'Teknik', 'Teknik Informatika', '123456', 'voter', TRUE, TRUE, NOW(), NOW()),
('210102', 'Siti Aminah', 'Teknik', 'Teknik Informatika', '123456', 'voter', FALSE, TRUE, NOW(), NOW()),
('210103', 'Ahmad Fauzi', 'Teknik', 'Teknik Informatika', '123456', 'voter', TRUE, TRUE, NOW(), NOW()),
('210104', 'Dewi Rahayu', 'Teknik', 'Teknik Informatika', '123456', 'voter', FALSE, TRUE, NOW(), NOW()),
('210105', 'Rizky Maulana', 'Teknik', 'Teknik Informatika', '123456', 'voter', TRUE, TRUE, NOW(), NOW()),
('210106', 'Layla Rahmawati', 'Teknik', 'Teknik Informatika', '123456', 'voter', FALSE, TRUE, NOW(), NOW()),
('210107', 'Fajar Nugroho', 'Teknik', 'Teknik Informatika', '123456', 'voter', FALSE, TRUE, NOW(), NOW()),
('210108', 'Anisa Permata', 'Teknik', 'Teknik Informatika', '123456', 'voter', FALSE, TRUE, NOW(), NOW());

INSERT INTO candidates (
    nomor_urut,
    nama_ketua,
    nama_wakil,
    jurusan,
    prodi,
    angkatan,
    visi,
    misi,
    program_kerja,
    foto,
    status,
    created_at,
    updated_at
) VALUES
(
    1,
    'Rizky Maulana',
    'Siti Nur Aisyah',
    'Teknik',
    'Teknik Informatika',
    '2022',
    'Mewujudkan kampus yang inklusif, inovatif, dan berdaya saing tinggi melalui kolaborasi aktif antar mahasiswa dan sivitas akademika.',
    'Meningkatkan kualitas komunikasi dan keterbukaan informasi antara BEM dan seluruh mahasiswa melalui platform digital yang mudah diakses dan transparan.\n\nMendorong partisipasi aktif mahasiswa dalam kegiatan organisasi, kepemimpinan, dan pengembangan diri melalui pelatihan, seminar, dan workshop yang relevan.\n\nMembangun jaringan kerja sama yang kuat dengan jurusan, universitas, dan lembaga eksternal guna membuka peluang pengembangan karir dan akademik bagi mahasiswa.',
    '[
        {"title":"Tech Connect Festival","description":"Acara tahunan yang menghubungkan mahasiswa dengan industri teknologi melalui pameran proyek, hackathon, dan sesi networking bersama perusahaan ternama."},
        {"title":"Portal Beasiswa & Info Akademik","description":"Platform digital terpusat yang menyediakan informasi beasiswa, jadwal akademik, dan pengumuman penting secara real-time untuk seluruh mahasiswa."},
        {"title":"Klinik Konsultasi Akademik","description":"Layanan konsultasi gratis oleh kakak tingkat dan alumni berprestasi untuk membantu mahasiswa dalam permasalahan akademik dan perencanaan karir."},
        {"title":"Gerakan Kampus Hijau","description":"Inisiatif ramah lingkungan yang mencakup penghijauan kampus, pengelolaan sampah terpadu, dan kampanye gaya hidup berkelanjutan di lingkungan jurusan."}
    ]',
    'assets/pdf-extracted/page03_img05.jpeg',
    'verified',
    NOW(),
    NOW()
),
(
    2,
    'Dimas Prasetyo',
    'Layla Rahmawati',
    'Ilmu Komunikasi',
    'Ilmu Komunikasi',
    '2022',
    'Membangun generasi mahasiswa yang berkarakter, berprestasi, dan peduli terhadap lingkungan sosial serta kemajuan bangsa Indonesia.',
    'Menguatkan ruang aspirasi mahasiswa yang responsif dan terbuka.\n\nMenyelenggarakan program pengembangan minat, bakat, dan prestasi mahasiswa.\n\nMenghadirkan kolaborasi sosial yang berdampak untuk lingkungan kampus.',
    '[
        {"title":"Aspirasi Digital","description":"Kanal pengaduan dan aspirasi yang mudah dipantau mahasiswa."},
        {"title":"Komunitas Prestasi","description":"Pendampingan lomba dan publikasi capaian mahasiswa."}
    ]',
    NULL,
    'verified',
    NOW(),
    NOW()
),
(
    3,
    'Fajar Nugroho',
    'Anisa Permata',
    'Ekonomi',
    'Manajemen Bisnis',
    '2021',
    'Mendorong partisipasi mahasiswa dalam setiap aspek kehidupan kampus dengan semangat kebersamaan, transparansi, dan integritas tinggi.',
    'Membuka ruang kolaborasi lintas jurusan.\n\nMengembangkan budaya organisasi yang transparan.\n\nMeningkatkan kesejahteraan dan layanan advokasi mahasiswa.',
    '[
        {"title":"Forum Kolaborasi","description":"Agenda rutin lintas jurusan untuk merancang kegiatan bersama."},
        {"title":"BEM Transparan","description":"Publikasi agenda, laporan kegiatan, dan penggunaan dana organisasi."}
    ]',
    NULL,
    'verified',
    NOW(),
    NOW()
);

INSERT INTO votes (
    pemilih_id,
    kandidat_id,
    dipilih_pada,
    created_at,
    updated_at
) VALUES
((SELECT id FROM users WHERE npm = '210101'), 1, DATE_SUB(NOW(), INTERVAL 120 MINUTE), NOW(), NOW()),
((SELECT id FROM users WHERE npm = '210103'), 2, DATE_SUB(NOW(), INTERVAL 90 MINUTE), NOW(), NOW()),
((SELECT id FROM users WHERE npm = '210105'), 1, DATE_SUB(NOW(), INTERVAL 45 MINUTE), NOW(), NOW());

INSERT INTO audit_logs (
    pengguna_id,
    aksi,
    alamat_ip,
    agen_pengguna,
    detail,
    created_at,
    updated_at
) VALUES
((SELECT id FROM users WHERE npm = 'admin001'), 'database_seeded', '127.0.0.1', 'SQL Import', '{"source":"database/evoting_bem.sql"}', NOW(), NOW());
