<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest {
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

		$bypass = $this->product_categories->id??'';

		return [
			'name'        => 'unique:products,name,'.$bypass,
			'price'       => 'numeric',
			'category_id' => 'integer',
			'image'       => 'mimes:png,jpeg,jpg|max:2048',
		];
	}

	public function failedValidation(Validator $validator) {
		throw new HttpResponseException(response()->json([
					'success' => false,
					'errors'  => $validator->errors()
				], Response::HTTP_BAD_REQUEST));
	}

}
