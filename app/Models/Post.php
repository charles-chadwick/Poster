<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;

/**
 * @method static where( string $string, $user_id )
 * @method static create( mixed $validated )
 */
class Post extends Base {
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status',
		'content',
		'user_id',
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
	public function comments() : HasMany {
		return $this->hasMany(Comment::class);
	}

	/**
	 * @return MorphToMany
	 */
	public function reactions() : MorphToMany {
		return $this->morphToMany(Reaction::class, 'reactionable');
	}
}
