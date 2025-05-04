<?php

namespace App\Models\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait HasActivity {
	use LogsActivity;

	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults()
			->useLogName(get_class($this))
			->logOnlyDirty();
		// Chain fluent methods for configuration options
	}
}