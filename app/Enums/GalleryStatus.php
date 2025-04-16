<?php

namespace App\Enums;

enum GalleryStatus: string
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
}
