<?php

namespace App\Models;

use App\Models\Traits\HasDateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model {
	use HasFactory, SoftDeletes;
	use HasDateFormat;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'type',
		'on',
		'on_id',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts() : array {
		return [
			'id' => 'integer',
		];
	}

	public function reactionable() : MorphTo {
		return $this->morphTo();
	}
}
