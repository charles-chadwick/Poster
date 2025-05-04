<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait HasDateFormat {

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