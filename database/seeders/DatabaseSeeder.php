<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Setting::create([
            'app_name' => 'BEM E-Voting',
            'election_title' => 'Pemilihan Umum BEM 2026',
            'voting_status' => 'open',
            'result_visibility' => true,
            'voting_start' => now()->subDay(),
            'voting_end' => now()->addDay(),
        ]);

        User::create([
            'npm' => 'admin001',
            'name' => 'FARU',
            'pin' => '123456',
            'role' => 'admin',
            'has_voted' => false,
            'is_active' => true,
        ]);

        $voters = [
            ['npm' => '210101', 'name' => 'Budi Santoso', 'has_voted' => true],
            ['npm' => '210102', 'name' => 'Siti Aminah', 'has_voted' => false],
            ['npm' => '210103', 'name' => 'Ahmad Fauzi', 'has_voted' => true],
            ['npm' => '210104', 'name' => 'Dewi Rahayu', 'has_voted' => false],
            ['npm' => '210105', 'name' => 'Rizky Maulana', 'has_voted' => true],
            ['npm' => '210106', 'name' => 'Layla Rahmawati', 'has_voted' => false],
            ['npm' => '210107', 'name' => 'Fajar Nugroho', 'has_voted' => false],
            ['npm' => '210108', 'name' => 'Anisa Permata', 'has_voted' => false],
        ];

        foreach ($voters as $voter) {
            User::create($voter + [
                'faculty' => 'Fakultas Teknik',
                'major' => 'Teknik Informatika',
                'pin' => '123456',
                'role' => 'voter',
                'is_active' => true,
            ]);
        }

        $candidateOne = Candidate::create([
            'serial_number' => 1,
            'chairman_name' => 'Rizky Maulana',
            'vice_name' => 'Siti Nur Aisyah',
            'faculty' => 'Fakultas Teknik',
            'major' => 'Teknik Informatika',
            'batch' => '2022',
            'vision' => 'Mewujudkan kampus yang inklusif, inovatif, dan berdaya saing tinggi melalui kolaborasi aktif antar mahasiswa dan sivitas akademika.',
            'mission' => "Meningkatkan kualitas komunikasi dan keterbukaan informasi antara BEM dan seluruh mahasiswa melalui platform digital yang mudah diakses dan transparan.\n\nMendorong partisipasi aktif mahasiswa dalam kegiatan organisasi, kepemimpinan, dan pengembangan diri melalui pelatihan, seminar, dan workshop yang relevan.\n\nMembangun jaringan kerja sama yang kuat dengan fakultas, universitas, dan lembaga eksternal guna membuka peluang pengembangan karir dan akademik bagi mahasiswa.",
            'work_programs' => [
                ['title' => 'Tech Connect Festival', 'description' => 'Acara tahunan yang menghubungkan mahasiswa dengan industri teknologi melalui pameran proyek, hackathon, dan sesi networking bersama perusahaan ternama.'],
                ['title' => 'Portal Beasiswa & Info Akademik', 'description' => 'Platform digital terpusat yang menyediakan informasi beasiswa, jadwal akademik, dan pengumuman penting secara real-time untuk seluruh mahasiswa.'],
                ['title' => 'Klinik Konsultasi Akademik', 'description' => 'Layanan konsultasi gratis oleh kakak tingkat dan alumni berprestasi untuk membantu mahasiswa dalam permasalahan akademik dan perencanaan karir.'],
                ['title' => 'Gerakan Kampus Hijau', 'description' => 'Inisiatif ramah lingkungan yang mencakup penghijauan kampus, pengelolaan sampah terpadu, dan kampanye gaya hidup berkelanjutan di lingkungan fakultas.'],
            ],
            'photo' => 'assets/pdf-extracted/page03_img05.jpeg',
            'status' => 'verified',
        ]);

        $candidateTwo = Candidate::create([
            'serial_number' => 2,
            'chairman_name' => 'Dimas Prasetyo',
            'vice_name' => 'Layla Rahmawati',
            'faculty' => 'Fakultas Ilmu Komunikasi',
            'major' => 'Ilmu Komunikasi',
            'batch' => '2022',
            'vision' => 'Membangun generasi mahasiswa yang berkarakter, berprestasi, dan peduli terhadap lingkungan sosial serta kemajuan bangsa Indonesia.',
            'mission' => "Menguatkan ruang aspirasi mahasiswa yang responsif dan terbuka.\n\nMenyelenggarakan program pengembangan minat, bakat, dan prestasi mahasiswa.\n\nMenghadirkan kolaborasi sosial yang berdampak untuk lingkungan kampus.",
            'work_programs' => [
                ['title' => 'Aspirasi Digital', 'description' => 'Kanal pengaduan dan aspirasi yang mudah dipantau mahasiswa.'],
                ['title' => 'Komunitas Prestasi', 'description' => 'Pendampingan lomba dan publikasi capaian mahasiswa.'],
            ],
            'status' => 'verified',
        ]);

        $candidateThree = Candidate::create([
            'serial_number' => 3,
            'chairman_name' => 'Fajar Nugroho',
            'vice_name' => 'Anisa Permata',
            'faculty' => 'Fakultas Ekonomi',
            'major' => 'Manajemen Bisnis',
            'batch' => '2021',
            'vision' => 'Mendorong partisipasi mahasiswa dalam setiap aspek kehidupan kampus dengan semangat kebersamaan, transparansi, dan integritas tinggi.',
            'mission' => "Membuka ruang kolaborasi lintas jurusan.\n\nMengembangkan budaya organisasi yang transparan.\n\nMeningkatkan kesejahteraan dan layanan advokasi mahasiswa.",
            'work_programs' => [
                ['title' => 'Forum Kolaborasi', 'description' => 'Agenda rutin lintas fakultas untuk merancang kegiatan bersama.'],
                ['title' => 'BEM Transparan', 'description' => 'Publikasi agenda, laporan kegiatan, dan penggunaan dana organisasi.'],
            ],
            'status' => 'verified',
        ]);

        $voteMap = [
            '210101' => $candidateOne->id,
            '210103' => $candidateTwo->id,
            '210105' => $candidateOne->id,
        ];

        foreach ($voteMap as $npm => $candidateId) {
            $user = User::where('npm', $npm)->first();

            Vote::create([
                'user_id' => $user->id,
                'candidate_id' => $candidateId,
                'voted_at' => now()->subMinutes(random_int(10, 180)),
            ]);
        }
    }
}
