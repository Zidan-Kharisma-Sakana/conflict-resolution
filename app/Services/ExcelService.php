<?php

namespace App\Services;

use App\Interfaces\ExcelServiceInterface;
use App\Models\Complaint\Pengaduan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExcelService implements ExcelServiceInterface
{
    public function getPengaduanExcel(Collection $pengaduans)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator(env('APP_NAME'))
            ->setLastModifiedBy(env('APP_NAME'))
            ->setTitle("Laporan Pengaduan BAPPEBTI " . Carbon::now()->isoFormat('D MMMM Y'));
        $spreadsheet->getActiveSheet()->setTitle("Pengaduan");

        $activeWorksheet = $spreadsheet->getActiveSheet();
        for ($i = 'B'; $i !=  "R"; $i++) {
            $activeWorksheet->getColumnDimension($i)->setAutoSize(false);
            $activeWorksheet->getStyle($i)->getAlignment()->setWrapText(true);
            $width_40 = in_array($i, ["D", "H", "O", "P", "Q"]); // Nama nasabah, perusahaan, keterangan, dan tindak lanjut
            $activeWorksheet->getColumnDimension($i)->setWidth($width_40 ? 40 : 20);
        }
        $this->writeHeaderAndStyle($activeWorksheet, $pengaduans);
        $this->writeRows($activeWorksheet, $pengaduans);
        return $spreadsheet;
    }
    private function writeHeaderAndStyle(Worksheet $worksheet, Collection $pengaduans)
    {
        $array = [
            ["REKAPITULASI PENGADUAN NASABAH SECARA ONLINE TAHUN 2023"],
            [],
            ["Nomor", "Status Pengaduan", "Tanggal Pengaduan", "Nama Nasabah", "Domisili Nasabah", "Pekerjaan Nasabah", "Telepon", "Perusahaan yang Diadukan", 'Pihak yang Diadukan', NULL, NULL, NULL, "Kantor Cabang", "Jumlah Kerugian", "Kronologis", "Keterangan", "Tindak Lanjut"],
            [NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Komisaris", "Kepala Cabang", "WPB", "Lainnya/Karyawan"]
        ];
        $worksheet->fromArray($array, NULL, 'A1');
        $worksheet->mergeCells('A1:Q1');
        $worksheet->getStyle('A:Q')->getAlignment()->setVertical('top');
        $worksheet->getStyle('A1:Q4')->getAlignment()->setHorizontal('center');
        $worksheet->getStyle('A')->getAlignment()->setHorizontal('center');
        $worksheet->getStyle('A3:Q4')->getAlignment()->setVertical('center');
        $worksheet
            ->getStyle('A3:Q4')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d9e2f3');
        for ($i = 'A'; $i !=  "R"; $i++) {
            if (!in_array($i, ['I', 'J', 'K', 'L'])) {
                $worksheet->mergeCells($i . '3:' . $i . '4');
            } elseif ($i == 'I') {
                $worksheet->mergeCells('I3:L3');
            }
        }
        $worksheet->getStyle('A3:Q' . (4 + count($pengaduans)))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
    }
    private function writeRows(Worksheet $worksheet, Collection $pengaduans)
    {
        $array = [];
        foreach ($pengaduans as $pengaduan) {
            $nasabah = $pengaduan->nasabah;
            $pihak = $this->getPihakPengaduan($pengaduan);
            // $this->getTimeline($pengaduan);
            $row = [
                $pengaduan->id,
                ucwords(str_replace('_', ' ', $pengaduan->status)),
                Carbon::parse($pengaduan->waktu_dibuat)->isoFormat('D MMMM Y'),
                $nasabah->user->name,
                $nasabah->kota_kabupaten . '/' . $nasabah->provinsi,
                $nasabah->pekerjaan,
                $nasabah->nomor_hp,
                $pengaduan->pialang->user->name,
                $pihak['komisaris'],
                $pihak['kacab'],
                $pihak['wpb'],
                $pihak['lainnya'],
                $pengaduan->pialang_cabang,
                'IDR' . number_format($pengaduan->kerugian),
                "",
                implode("\n\n",  $this->getTimeline($pengaduan)),
                ""
            ];
            array_push($array, $row);
        }
        $worksheet->fromArray($array, NULL, 'A5');
    }
    private function getPihakPengaduan(Pengaduan $pengaduan): array
    {
        $komisaris = [];
        $kacab = [];
        $wpb = [];
        $lainnya = [];
        foreach ($pengaduan->terlapor as $orang) {
            $jabatan = $orang['jabatan'];
            if ($jabatan == 'komisaris') {
                array_push($komisaris, $orang['nama'] ?? '-');
            } elseif ($jabatan == 'kacab') {
                array_push($kacab, $orang['nama'] ?? '-');
            } elseif ($jabatan == 'wpb') {
                array_push($wpb, $orang['nama'] ?? '-');
            } elseif ($jabatan == 'lainnya') {
                array_push($lainnya, $orang['nama'] ?? '-');
            }
        }
        return [
            "komisaris" => implode("\n\n", $komisaris),
            "kacab" => implode("\n\n", $kacab),
            "wpb" => implode("\n\n", $wpb),
            "lainnya" => implode("\n\n", $lainnya),
        ];
    }

    private function getTimeline(Pengaduan $pengaduan)
    {
        $array = [];
        array_push($array, "Menunggu pemeriksaan berkas maksimal " . Carbon::parse($pengaduan->waktu_expires_bappebti)->isoFormat("D MMMM Y"));
        if ($pengaduan->status != Pengaduan::STATUS_CREATED) {
            $expires_pialang =  Carbon::parse($pengaduan->waktu_expires_pialang)->isoFormat("D MMMM Y");
            $start_disposisi =  Carbon::parse($pengaduan->waktu_expires_pialang)->subWeekdays(21)->isoFormat("D MMMM Y");
            array_push($array, "Pengaduan didisposisi ke pialang pada " . $start_disposisi . ' dengan deadline ' . $expires_pialang);
        }
        if (count($pengaduan->musyawarahs)) {
            // iterate over them
            $musyawarahs = $pengaduan->musyawarahs->sortBy('tanggal_waktu');
            foreach ($musyawarahs as $musyawarah) {
                $t = Carbon::parse($musyawarah->tanggal_waktu);
                if (empty($musyawarah->hasil)) {
                    array_push($array, "Musyawarah dijadwalkan pialang pada " . $t->isoFormat("D MMMM Y"));
                } else {
                    array_push($array, "Musyawarah selesai pada " . $t->isoFormat("D MMMM Y") . ' dengan hasil ' . $musyawarah->hasil);
                }
            }
        }
        if ($pengaduan->status == Pengaduan::STATUS_DISPOSISI_PIALANG) {
            // case 2: dalam deadline pialang, belum ada hasil
            array_push($array, "Pialang belum mencapai kesepakatan hingga saat ini (" . Carbon::now()->isoFormat("D MMMM Y") . ")");
        }
        if (!empty($pengaduan->waktu_kesepakatan) && !$pengaduan->is_pialang_late && !$pengaduan->is_bursa_late) {
            // case 3: dalam deadline pialang, sudah ada hasil
            array_push($array, "Pialang mencapai kesepakatan pada " . Carbon::parse($pengaduan->waktu_kesepakatan)->isoFormat("D MMMM Y"));
        }
        if ($pengaduan->is_pialang_late) {
            $expires_bursa =  Carbon::parse($pengaduan->waktu_expires_bursa)->isoFormat("D MMMM Y");
            $start_disposisi =  Carbon::parse($pengaduan->waktu_expires_bursa)->subWeekdays(21)->isoFormat("D MMMM Y");
            array_push($array, "Pengaduan didisposisi ke bursa pada " . $start_disposisi . ' dengan deadline ' . $expires_bursa);
        }
        if (count($pengaduan->mediasis)) {
            // iterate over them
            $mediasis = $pengaduan->mediasis->sortBy('tanggal_waktu');
            foreach ($mediasis as $mediasi) {
                $t = Carbon::parse($mediasi->tanggal_waktu);
                if (empty($mediasi->hasil)) {
                    array_push($array, "mediasi dijadwalkan pialang pada " . $t->isoFormat("D MMMM Y"));
                } else {
                    array_push($array, "mediasi selesai pada " . $t->isoFormat("D MMMM Y") . ' dengan hasil ' . $mediasi->hasil);
                }
            }
        }
        if ($pengaduan->status == Pengaduan::STATUS_DISPOSISI_BURSA) {
            // case 4: dalam deadline bursa, belum ada hasil
            array_push($array, "Bursa belum mencapai kesepakatan hingga saat ini (" . Carbon::now()->isoFormat("D MMMM Y") . ")");
        }
        if (!empty($pengaduan->waktu_kesepakatan)  && !$pengaduan->is_bursa_late && $pengaduan->is_pialang_late) {
            // case 5: dalam deadline bursa, sudah ada hasil
            array_push($array, "Bursa mencapai kesepakatan pada " . Carbon::parse($pengaduan->waktu_kesepakatan)->isoFormat("D MMMM Y"));
        }
        if ($pengaduan->is_pialang_late && $pengaduan->is_bursa_late) {
            // case 6: diluar deadline bursa, belum ada hasil
            array_push($array, "Bursa melewati deadline yang ditentukan pada " . Carbon::parse($pengaduan->waktu_expires_bursa));
        }
        if (!empty($pengaduan->waktu_kesepakatan) && $pengaduan->is_bursa_late && $pengaduan->is_pialang_late) {
            // case 7: diluar deadline bursa, sudah ada hasil
            array_push($array, "Bursa melewati deadline, namun mencapai kesepakatan pada " . Carbon::parse($pengaduan->waktu_kesepakatan)->isoFormat("D MMMM Y"));
        }
        if ($pengaduan->status == Pengaduan::STATUS_CLOSED) {
            array_push($array, "Pengaduan ditutup pada " . Carbon::parse($pengaduan->waktu_selesai));
        }
        return $array;
    }
}
