<?php


namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	/** @use HasFactory<UserFactory> */
	use HasFactory, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'role',
		'status',
		'first_name',
		'last_name',
		'email',
		'email_verified_at',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts() : array {
		return [
			'id'                => 'integer',
			'email_verified_at' => 'timestamp',
		];
	}

	public function getFullNameAttribute() : string {
		return trim($this->first_name.' '.$this->last_name);
	}
}
