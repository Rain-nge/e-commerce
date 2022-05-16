<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface {

	/**
	 * @var Model
	 */
	protected $model;

	public function __construct(Product $model) {
		$this->model = $model;
	}

	public function all() {
		return $this->model->with('productCategory')->latest()->get();
	}

	public function findById($id) {
		return $this->model->with('productCategory')->find($id);
	}

	public function create(array $attributes) {
		return $this->model->create($attributes)->load('productCategory');
	}

	public function update(object $model, array $attributes) {
		$model->update($attributes);
		return $model->refresh();
	}

	public function delete($id) {
		return $this->model->destroy($id);
	}

}