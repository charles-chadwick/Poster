<?php

namespace App\Enums;

enum CommentStatus: string
{
	case Published   = 'Published';
	case Draft       = 'Draft';
	case Removed     = 'Removed';
}
