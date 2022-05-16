<?php
namespace App\Services;

use App\Http\Resources\CartItemResource;
use App\Interfaces\CartItemInterface;
use App\Traits\ServiceCustomMessage;
use Illuminate\Http\Response;

class CartItemService {
	use ServiceCustomMessage;

	/**
	 * @var $cartItemInterface
	 */
	protected $cartItemInterface;

	public function __construct(CartItemInterface $cartItemInterface) {

		$this->cartItemInterface = $cartItemInterface;
	}

	public function all() {

		$data = $this->cartItemInterface->all();

		return response(
			[
				'success' => true,
				'data'    => new CartItemResource($data)
			],
			Response::HTTP_OK
		);
	}

	public function findById($id) {

		$data = $this->cartItemInterface->findById($id);

		if ($data) {

			return response(
				[
					'success' => true,
					'data'    => new CartItemResource($data)
				],
				Response::HTTP_OK
			);
		}

		return response(
			[
				'success' => false,
				'errors'  => $this->idNotFound($id)
			],
			Response::HTTP_NOT_FOUND
		);

	}

	public function create(array $attributes) {

		$data = $this->cartItemInterface->create($attributes);

		return response(
			[
				'success' => true,
				'data'    => new CartItemResource($data)
			],
			Response::HTTP_CREATED
		);
	}

	public function update($id, array $attributes) {

		$result = $this->cartItemInterface->findById($id);

		if ($result) {

			$data = $this->cartItemInterface->update($result, $attributes);

			return response(
				[
					'success' => true,
					'data'    => new CartItemResource($data)
				],
				Response::HTTP_OK
			);
		}

		return response(
			[
				'success' => false,
				'errors'  => $this->idNotFound($id)
			],
			Response::HTTP_NOT_FOUND
		);
	}

	public function delete($id) {

		$result = $this->cartItemInterface->findById($id);

		if ($result) {

			$this->cartItemInterface->delete($id);
			return response(null, Response::HTTP_NO_CONTENT);
		}

		return response(
			[
				'success' => false,
				'errors'  => $this->idNotFound($id)
			],
			Response::HTTP_NOT_FOUND
		);
	}
}
