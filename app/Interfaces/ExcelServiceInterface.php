<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ExcelServiceInterface
{
    public function getPengaduanExcel(Collection $pengaduans);
}
