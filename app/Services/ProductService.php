<?php
namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use App\Traits\FileUpload;
use App\Traits\ServiceCustomMessage;
use Illuminate\Http\Response;

class ProductService {
	use ServiceCustomMessage, FileUpload;

	/**
	 * @var $productInterface
	 */
	protected $productInterface;

	public function __construct(ProductInterface $productInterface) {

		$this->productInterface = $productInterface;
	}

	public function all() {

		$data = $this->productInterface->all();

		return response(
			[
				'success' => true,
				'data'    => new ProductResource($data)
			],
			Response::HTTP_OK
		);
	}

	public function findById($id) {

		$data = $this->productInterface->findById($id);

		if ($data) {

			return response(
				[
					'success' => true,
					'data'    => new ProductResource($data)
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

		if (isset($attributes['image'])) {
			$filePath            = 'public/products/'.$attributes['category_id'];
			$attributes['image'] = $this->moveFile($filePath, $attributes['image']);
		}

		$data = $this->productInterface->create($attributes);

		return response(
			[
				'success' => true,
				'data'    => new ProductResource($data)
			],
			Response::HTTP_CREATED
		);
	}

	public function update($id, array $attributes) {

		$result = $this->productInterface->findById($id);

		if ($result) {

			if (isset($attributes['image'])) {

				$filePath = 'public/products/'.$result->category_id;
				if (!is_null($result->image)) {
					$this->removeExistingFile($filePath.'/'.$result->image);
				}
				$attributes['image'] = $this->moveFile($filePath, $attributes['image']);
			}

			$data = $this->productInterface->update($result, $attributes);

			return response(
				[
					'success' => true,
					'data'    => new ProductResource($data)
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

		$result = $this->productInterface->findById($id);

		if ($result) {

			$this->productInterface->delete($id);
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
