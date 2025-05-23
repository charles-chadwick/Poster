<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize() : bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 */
	public function rules() : array {
		return [
			'status'  => [
				'required',
				'string',
				'max:25'
			],
			'content' => [
				'required',
				'string'
			],
			'post_id' => [
				'required',
				'integer',
				'exists:posts,id'
			],
			'user_id' => [
				'required',
				'integer',
				'exists:users,id'
			],
		];
	}
}
