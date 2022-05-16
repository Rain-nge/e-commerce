<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryInterface {

	/**
	 * @var Model
	 */
	protected $model;

	public function __construct(ProductCategory $model) {
		$this->model = $model;
	}

	public function all() {
		return $this->model->latest()->get();
	}

	public function findById($id) {
		return $this->model->find($id);
	}

	public function create(array $attributes) {
		return $this->model->create($attributes);
	}

	public function update(object $model, array $attributes) {
		$model->update($attributes);
		return $model->refresh();
	}

	public function delete($id) {
		return $this->model->destroy($id);
	}

}