<?php

namespace App\Enums;

enum PostStatus: string
{
    case Published   = 'Published';
	case Draft       = 'Draft';
	case Removed     = 'Removed';
}
