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
        for ($i = 'B'; $i !=  "O"; $i++) {
            $activeWorksheet->getColumnDimension($i)->setAutoSize(false);
            $activeWorksheet->getStyle($i)->getAlignment()->setWrapText(true);
            $width_40 = in_array($i, ["C", "G"]);
            $activeWorksheet->getColumnDimension($i)->setWidth($width_40 ? 40 : 20);
        }
        $this->writeHeader($activeWorksheet);
        $this->writeRows($activeWorksheet, $pengaduans);
        return $spreadsheet;
    }
    private function writeHeader(Worksheet $worksheet)
    {
        $array = [
            ["REKAPITULASI PENGADUAN NASABAH SECARA ONLINE TAHUN 2023"],
            [],
            ["Nomor", "Tanggal Pengaduan", "Nama Nasabah", "Domisili Nasabah", "Pekerjaan Nasabah", "Telepon", "Perusahaan yang Diadukan", 'Pihak yang Diadukan', NULL, NULL, NULL, "Kantor Cabang", "Jumlah Kerugian", "Keterangan"],
            [NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Komisaris", "Kepala Cabang", "WPB", "Lainnya/Karyawan"]
        ];
        $worksheet->fromArray($array, NULL, 'A1');
        $worksheet->mergeCells('A1:M1');
        $worksheet->getStyle('A:N')->getAlignment()->setVertical('top');
        $worksheet->getStyle('A1:N4')->getAlignment()->setHorizontal('center');
        $worksheet->getStyle('A')->getAlignment()->setHorizontal('center');
        $worksheet->getStyle('A3:N4')->getAlignment()->setVertical('center');
        $worksheet
            ->getStyle('A3:N4')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d9e2f3');
        for ($i = 'A'; $i !=  "O"; $i++) {
            if (!in_array($i, ['H', 'I', 'J', 'K'])) {
                $worksheet->mergeCells($i . '3:' . $i . '4');
            } elseif ($i == 'H') {
                $worksheet->mergeCells('H3:K3');
            }
        }
    }
    private function writeRows(Worksheet $worksheet, Collection $pengaduans)
    {
        $array = [];
        foreach ($pengaduans as $pengaduan) {
            $nasabah = $pengaduan->nasabah;
            $pihak = $this->getPihakPengaduan($pengaduan);
            $row = [
                $pengaduan->id,
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
                $pengaduan->status
            ];
            array_push($array, $row);
        }
        $worksheet->fromArray($array, NULL, 'A5');
        $worksheet->getStyle('A3:N' . (4 + count($pengaduans)))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));
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
}
