<?php

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'Draft';
    case Published = 'Published';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
}
