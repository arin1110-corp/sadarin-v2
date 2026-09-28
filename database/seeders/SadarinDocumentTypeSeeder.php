<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SadarinDocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $documentTypes = [

            // =========================================================
            // SURAT MENYURAT
            // =========================================================

            [
                'name' => 'Surat Masuk',
                'description' => 'Dokumen surat yang diterima oleh Dinas Kebudayaan.',
            ],
            [
                'name' => 'Surat Keluar',
                'description' => 'Dokumen surat yang diterbitkan oleh Dinas Kebudayaan.',
            ],
            [
                'name' => 'Surat Dinas',
                'description' => 'Surat resmi kedinasan untuk kebutuhan administrasi pemerintahan.',
            ],
            [
                'name' => 'Surat Tugas',
                'description' => 'Dokumen penugasan pegawai untuk melaksanakan tugas kedinasan.',
            ],
            [
                'name' => 'Surat Perintah',
                'description' => 'Dokumen perintah kedinasan kepada pegawai atau pihak terkait.',
            ],
            [
                'name' => 'Surat Undangan',
                'description' => 'Dokumen undangan rapat, kegiatan, acara, atau agenda kedinasan.',
            ],
            [
                'name' => 'Surat Edaran',
                'description' => 'Dokumen penyampaian informasi atau ketentuan kepada pihak terkait.',
            ],
            [
                'name' => 'Nota Dinas',
                'description' => 'Dokumen komunikasi kedinasan internal antarpejabat atau unit kerja.',
            ],
            [
                'name' => 'Memo Dinas',
                'description' => 'Dokumen komunikasi singkat untuk kebutuhan internal kedinasan.',
            ],
            [
                'name' => 'Disposisi',
                'description' => 'Dokumen arahan atau tindak lanjut terhadap surat atau dokumen masuk.',
            ],

            // =========================================================
            // PERENCANAAN
            // =========================================================

            [
                'name' => 'Renstra',
                'description' => 'Dokumen Rencana Strategis perangkat daerah.',
            ],
            [
                'name' => 'Renja',
                'description' => 'Dokumen Rencana Kerja perangkat daerah.',
            ],
            [
                'name' => 'Rencana Kerja Tahunan',
                'description' => 'Dokumen perencanaan kegiatan tahunan perangkat daerah.',
            ],
            [
                'name' => 'Rencana Kegiatan',
                'description' => 'Dokumen perencanaan pelaksanaan suatu kegiatan.',
            ],
            [
                'name' => 'DPA',
                'description' => 'Dokumen Pelaksanaan Anggaran perangkat daerah.',
            ],
            [
                'name' => 'DPPA',
                'description' => 'Dokumen perubahan pelaksanaan anggaran perangkat daerah.',
            ],
            [
                'name' => 'KAK',
                'description' => 'Kerangka Acuan Kerja suatu kegiatan atau pekerjaan.',
            ],
            [
                'name' => 'RAB',
                'description' => 'Rencana Anggaran Biaya kegiatan atau pekerjaan.',
            ],
            [
                'name' => 'TOR',
                'description' => 'Term of Reference kegiatan atau pekerjaan.',
            ],
            [
                'name' => 'Jadwal Kegiatan',
                'description' => 'Dokumen jadwal pelaksanaan kegiatan.',
            ],

            // =========================================================
            // KEUANGAN
            // =========================================================

            [
                'name' => 'SPJ',
                'description' => 'Surat Pertanggungjawaban pelaksanaan kegiatan atau penggunaan anggaran.',
            ],
            [
                'name' => 'SPJ Kegiatan',
                'description' => 'Dokumen pertanggungjawaban keuangan suatu kegiatan.',
            ],
            [
                'name' => 'Kwitansi',
                'description' => 'Dokumen bukti penerimaan atau pembayaran.',
            ],
            [
                'name' => 'Nota Pembayaran',
                'description' => 'Dokumen bukti transaksi atau pembayaran.',
            ],
            [
                'name' => 'Bukti Pengeluaran',
                'description' => 'Dokumen bukti pengeluaran anggaran.',
            ],
            [
                'name' => 'Laporan Keuangan',
                'description' => 'Dokumen laporan terkait pelaksanaan dan penggunaan keuangan.',
            ],
            [
                'name' => 'Buku Kas',
                'description' => 'Dokumen pencatatan transaksi kas.',
            ],
            [
                'name' => 'Rekapitulasi Keuangan',
                'description' => 'Dokumen rekapitulasi transaksi dan penggunaan anggaran.',
            ],
            [
                'name' => 'Daftar Pembayaran',
                'description' => 'Dokumen daftar pembayaran kepada pihak terkait.',
            ],
            [
                'name' => 'Dokumen Pajak',
                'description' => 'Dokumen terkait pemungutan dan pembayaran pajak.',
            ],

            // =========================================================
            // KEPEGAWAIAN
            // =========================================================

            [
                'name' => 'SK Pegawai',
                'description' => 'Surat Keputusan yang berkaitan dengan pegawai.',
            ],
            [
                'name' => 'SK Pengangkatan',
                'description' => 'Dokumen keputusan pengangkatan pegawai atau pejabat.',
            ],
            [
                'name' => 'SK Mutasi',
                'description' => 'Dokumen keputusan mutasi pegawai.',
            ],
            [
                'name' => 'SK Kenaikan Pangkat',
                'description' => 'Dokumen keputusan kenaikan pangkat pegawai.',
            ],
            [
                'name' => 'SK Kenaikan Gaji Berkala',
                'description' => 'Dokumen keputusan kenaikan gaji berkala pegawai.',
            ],
            [
                'name' => 'Daftar Pegawai',
                'description' => 'Dokumen daftar pegawai dalam lingkungan perangkat daerah.',
            ],
            [
                'name' => 'Daftar Hadir',
                'description' => 'Dokumen pencatatan kehadiran pegawai atau peserta kegiatan.',
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Dokumen izin pegawai untuk keperluan kedinasan atau pribadi.',
            ],
            [
                'name' => 'Surat Cuti',
                'description' => 'Dokumen pengajuan atau persetujuan cuti pegawai.',
            ],
            [
                'name' => 'Dokumen KGB',
                'description' => 'Dokumen terkait kenaikan gaji berkala pegawai.',
            ],

            // =========================================================
            // KEGIATAN DINAS
            // =========================================================

            [
                'name' => 'Proposal Kegiatan',
                'description' => 'Dokumen usulan pelaksanaan kegiatan.',
            ],
            [
                'name' => 'Undangan Kegiatan',
                'description' => 'Dokumen undangan untuk pelaksanaan kegiatan.',
            ],
            [
                'name' => 'Daftar Peserta',
                'description' => 'Dokumen daftar peserta kegiatan.',
            ],
            [
                'name' => 'Berita Acara',
                'description' => 'Dokumen berita acara pelaksanaan atau hasil suatu kegiatan.',
            ],
            [
                'name' => 'Laporan Kegiatan',
                'description' => 'Dokumen laporan pelaksanaan suatu kegiatan.',
            ],
            [
                'name' => 'Laporan Pelaksanaan',
                'description' => 'Dokumen laporan pelaksanaan program atau kegiatan.',
            ],
            [
                'name' => 'Dokumentasi Kegiatan',
                'description' => 'Dokumen berupa foto atau dokumentasi pelaksanaan kegiatan.',
            ],
            [
                'name' => 'Notulen Rapat',
                'description' => 'Dokumen hasil pencatatan pembahasan dan keputusan rapat.',
            ],
            [
                'name' => 'Daftar Inventaris',
                'description' => 'Dokumen pencatatan barang atau aset yang dimiliki atau digunakan.',
            ],
            [
                'name' => 'Laporan Perjalanan Dinas',
                'description' => 'Dokumen laporan pelaksanaan perjalanan dinas.',
            ],

        ];

        foreach ($documentTypes as $documentType) {

            DB::table('sadarin_document_type')->updateOrInsert(
                [
                    'document_type_name' => $documentType['name'],
                ],
                [
                    'document_type_uid' => (string) Str::uuid(),
                    'document_type_description' => $documentType['description'],
                    'document_type_is_active' => true,
                    'document_type_updated_at' => now(),
                ]
            );
        }
    }
}