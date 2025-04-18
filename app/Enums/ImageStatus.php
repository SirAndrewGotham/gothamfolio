<?php

namespace App\Enums;

enum ImageStatus: string
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
}
