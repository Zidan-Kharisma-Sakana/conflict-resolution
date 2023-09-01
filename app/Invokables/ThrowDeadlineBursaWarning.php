<?php

namespace App\Invokables;

use Carbon\Carbon;

class ThrowDeadlineBursaWarning
{
    public function __invoke()
    {
        // error_log(Carbon::now());
    }
}
