<?php

namespace App\Models;

use App\Models\Traits\HasDateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where( string $string, mixed $request )
 * @method static create( mixed $validated )
 */
class Comment extends Model {
	use HasFactory, SoftDeletes;
	use HasDateFormat;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status',
		'content',
		'post_id',
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
			'post_id' => 'integer',
			'user_id' => 'integer',
		];
	}

	public function post() : BelongsTo {
		return $this->belongsTo(Post::class);
	}

	public function user() : BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function reactions() : MorphToMany {
		return $this->morphToMany(Reaction::class, 'reactionable');
	}
}
