<?php

namespace App\Enums;

enum UserRole: string {
	case SuperAdmin = 'Super Admin';
	case User       = 'User';
}
