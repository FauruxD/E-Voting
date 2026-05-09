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
            'nama_aplikasi' => 'BEM E-Voting',
            'judul_pemilihan' => 'Pemilihan Umum BEM 2026',
            'status_voting' => 'open',
            'hasil_ditampilkan' => true,
            'mulai_voting' => now()->subDay(),
            'selesai_voting' => now()->addDay(),
        ]);

        User::create([
            'npm' => 'admin001',
            'nama' => 'FARU',
            'pin' => '123456',
            'peran' => 'admin',
            'sudah_memilih' => false,
            'aktif' => true,
        ]);

        $voters = [
            ['npm' => '210101', 'nama' => 'Budi Santoso', 'sudah_memilih' => true],
            ['npm' => '210102', 'nama' => 'Siti Aminah', 'sudah_memilih' => false],
            ['npm' => '210103', 'nama' => 'Ahmad Fauzi', 'sudah_memilih' => true],
            ['npm' => '210104', 'nama' => 'Dewi Rahayu', 'sudah_memilih' => false],
            ['npm' => '210105', 'nama' => 'Rizky Maulana', 'sudah_memilih' => true],
            ['npm' => '210106', 'nama' => 'Layla Rahmawati', 'sudah_memilih' => false],
            ['npm' => '210107', 'nama' => 'Fajar Nugroho', 'sudah_memilih' => false],
            ['npm' => '210108', 'nama' => 'Anisa Permata', 'sudah_memilih' => false],
        ];

        foreach ($voters as $voter) {
            User::create($voter + [
                'jurusan' => 'Teknik',
                'prodi' => 'Teknik Informatika',
                'pin' => '123456',
                'peran' => 'voter',
                'aktif' => true,
            ]);
        }

        $candidateOne = Candidate::create([
            'nomor_urut' => 1,
            'nama_ketua' => 'Rizky Maulana',
            'nama_wakil' => 'Siti Nur Aisyah',
            'jurusan' => 'Teknik',
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2022',
            'visi' => 'Mewujudkan kampus yang inklusif, inovatif, dan berdaya saing tinggi melalui kolaborasi aktif antar mahasiswa dan sivitas akademika.',
            'misi' => "Meningkatkan kualitas komunikasi dan keterbukaan informasi antara BEM dan seluruh mahasiswa melalui platform digital yang mudah diakses dan transparan.\n\nMendorong partisipasi aktif mahasiswa dalam kegiatan organisasi, kepemimpinan, dan pengembangan diri melalui pelatihan, seminar, dan workshop yang relevan.\n\nMembangun jaringan kerja sama yang kuat dengan fakultas, universitas, dan lembaga eksternal guna membuka peluang pengembangan karir dan akademik bagi mahasiswa.",
            'program_kerja' => [
                ['title' => 'Tech Connect Festival', 'description' => 'Acara tahunan yang menghubungkan mahasiswa dengan industri teknologi melalui pameran proyek, hackathon, dan sesi networking bersama perusahaan ternama.'],
                ['title' => 'Portal Beasiswa & Info Akademik', 'description' => 'Platform digital terpusat yang menyediakan informasi beasiswa, jadwal akademik, dan pengumuman penting secara real-time untuk seluruh mahasiswa.'],
                ['title' => 'Klinik Konsultasi Akademik', 'description' => 'Layanan konsultasi gratis oleh kakak tingkat dan alumni berprestasi untuk membantu mahasiswa dalam permasalahan akademik dan perencanaan karir.'],
                ['title' => 'Gerakan Kampus Hijau', 'description' => 'Inisiatif ramah lingkungan yang mencakup penghijauan kampus, pengelolaan sampah terpadu, dan kampanye gaya hidup berkelanjutan di lingkungan fakultas.'],
            ],
            'foto' => null,
            'status' => 'verified',
        ]);

        $candidateTwo = Candidate::create([
            'nomor_urut' => 2,
            'nama_ketua' => 'Dimas Prasetyo',
            'nama_wakil' => 'Layla Rahmawati',
            'jurusan' => 'Ilmu Komunikasi',
            'prodi' => 'Ilmu Komunikasi',
            'angkatan' => '2022',
            'visi' => 'Membangun generasi mahasiswa yang berkarakter, berprestasi, dan peduli terhadap lingkungan sosial serta kemajuan bangsa Indonesia.',
            'misi' => "Menguatkan ruang aspirasi mahasiswa yang responsif dan terbuka.\n\nMenyelenggarakan program pengembangan minat, bakat, dan prestasi mahasiswa.\n\nMenghadirkan kolaborasi sosial yang berdampak untuk lingkungan kampus.",
            'program_kerja' => [
                ['title' => 'Aspirasi Digital', 'description' => 'Kanal pengaduan dan aspirasi yang mudah dipantau mahasiswa.'],
                ['title' => 'Komunitas Prestasi', 'description' => 'Pendampingan lomba dan publikasi capaian mahasiswa.'],
            ],
            'status' => 'verified',
        ]);

        $candidateThree = Candidate::create([
            'nomor_urut' => 3,
            'nama_ketua' => 'Fajar Nugroho',
            'nama_wakil' => 'Anisa Permata',
            'jurusan' => 'Ekonomi',
            'prodi' => 'Manajemen Bisnis',
            'angkatan' => '2021',
            'visi' => 'Mendorong partisipasi mahasiswa dalam setiap aspek kehidupan kampus dengan semangat kebersamaan, transparansi, dan integritas tinggi.',
            'misi' => "Membuka ruang kolaborasi lintas jurusan.\n\nMengembangkan budaya organisasi yang transparan.\n\nMeningkatkan kesejahteraan dan layanan advokasi mahasiswa.",
            'program_kerja' => [
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
                'pemilih_id' => $user->id,
                'kandidat_id' => $candidateId,
                'dipilih_pada' => now()->subMinutes(random_int(10, 180)),
            ]);
        }
    }
}
