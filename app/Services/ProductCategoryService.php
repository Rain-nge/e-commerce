<?php
namespace App\Services;

use App\Http\Resources\ProductCategoryResource;
use App\Interfaces\ProductCategoryInterface;
use App\Traits\ServiceCustomMessage;
use Illuminate\Http\Response;

class ProductCategoryService {
	use ServiceCustomMessage;

	/**
	 * @var $productCategoryInterface
	 */
	protected $productCategoryInterface;

	public function __construct(ProductCategoryInterface $productCategoryInterface) {

		$this->productCategoryInterface = $productCategoryInterface;
	}

	public function all() {

		$data = $this->productCategoryInterface->all();

		return response(
			[
				'success' => true,
				'data'    => new ProductCategoryResource($data)
			],
			Response::HTTP_OK
		);
	}

	public function findById($id) {

		$data = $this->productCategoryInterface->findById($id);

		if ($data) {

			return response(
				[
					'success' => true,
					'data'    => new ProductCategoryResource($data)
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

		$data = $this->productCategoryInterface->create($attributes);

		return response(
			[
				'success' => true,
				'data'    => new ProductCategoryResource($data)
			],
			Response::HTTP_CREATED
		);
	}

	public function update($id, array $attributes) {

		$result = $this->productCategoryInterface->findById($id);

		if ($result) {

			$data = $this->productCategoryInterface->update($result, $attributes);

			return response(
				[
					'success' => true,
					'data'    => new ProductCategoryResource($data)
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

		$result = $this->productCategoryInterface->findById($id);

		if ($result) {

			$this->productCategoryInterface->delete($id);
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
