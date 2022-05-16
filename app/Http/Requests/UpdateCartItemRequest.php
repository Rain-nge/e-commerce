<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateCartItemRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		// $bypass = $this->cart_items->id??'';

		return [
			'product_id' => 'required|integer'
		];

	}

	public function failedValidation(Validator $validator) {
		throw new HttpResponseException(response()->json([
					'success' => false,
					'errors'  => $validator->errors()
				], Response::HTTP_BAD_REQUEST));
	}
}
