<?php

namespace App\Models;

use Database\Factories\FollowerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Follower extends Base {
	/** @use HasFactory<FollowerFactory> */
	use HasFactory;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status',
		'user_id',
		'follower_id',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts() : array {
		return [
			'id'      => 'integer',
			'user_id' => 'integer',
		];
	}

	/**
	 * @return BelongsTo
	 */
	public function user() : BelongsTo {
		return $this->belongsTo(User::class);
	}

	/**
	 * @return HasMany
	 */
	public function followers() : HasMany {
		return $this->hasMany(User::class, "id", "follower_id");
	}
}
