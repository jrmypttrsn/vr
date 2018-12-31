<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ReportGrade extends Enum
{
    const Unsatisfactory = 0;
    const Satisfactory = 1;
    const Good = 2;
    const Excellent = 3;
}
