<?php

namespace App\Enums;

enum WorkStatus: string
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
}
