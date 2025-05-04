<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Base extends Model implements HasMedia {
	use SoftDeletes;
	use LogsActivity, InteractsWithMedia;

	public function __construct(array $attributes = []) {
		parent::__construct($attributes);
	}

	/**
	 * Spatie's Media Conversions
	 * @param  Media|null  $media
	 * @return void
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this
			->addMediaConversion('preview')
			->fit(Fit::Contain, 300, 300)
			->nonQueued();
	}

	/**
	 * Spatie's Activity Log functions
	 * @return LogOptions
	 */
	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults()
						 ->useLogName(get_class($this))
						 ->logOnlyDirty();
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getCreatedAtAttribute( $value ) : string {
		return $this->dateFormat($value);
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getCreatedAtHumanAttribute( $value ) : string {
		return $this->dateFormat($this->created_at, "human");
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getUpdatedAtAttribute( $value ) : string {
		return $this->dateFormat($value);
	}

	/**
	 * @return string
	 */
	public function getUpdatedAtHumanAttribute() : string {
		return $this->dateFormat($this->updated_at, "human");
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getDeletedAtAttribute( $value ) : string {
		return $this->dateFormat($value);
	}

	/**
	 * @return string
	 */
	public function getDeletedAtHumanAttribute() : string {
		return $this->dateFormat($this->deleted_at, "human");
	}

	/**
	 * @param $value
	 * @param  null  $format
	 * @return string
	 */
	public function dateFormat( $value, $format = null ) : string {
		return match ( true ) {
			$format === "human" => Carbon::parse($value)
										 ->diffForHumans(),
			default             => Carbon::parse($value)
										 ->format('m/d/Y h:i A')
		};
	}
}