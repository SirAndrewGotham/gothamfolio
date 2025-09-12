<?php

namespace App\Enums;

enum CompetenceStatus: string
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
}
