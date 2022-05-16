<?php

namespace App\Repositories;

use App\Interfaces\CartItemInterface;
use App\Models\CartItem;

class CartItemRepository implements CartItemInterface {

	/**
	 * @var Model
	 */
	protected $model;

	public function __construct(CartItem $model) {
		$this->model = $model;
	}

	public function all() {
		return $this->model->with('product.productCategory')->latest()->get();
	}

	public function findById($id) {
		return $this->model->with('product.productCategory')->find($id);
	}

	public function create(array $attributes) {
		return $this->model->create($attributes)->load('product.productCategory');
	}

	public function update(object $model, array $attributes) {
		$model->update($attributes);
		return $model->refresh()->load('product.productCategory');

	}

	public function delete($id) {
		return $this->model->destroy($id);
	}

}