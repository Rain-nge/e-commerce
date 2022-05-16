<?php
namespace App\Interfaces;

interface CartItemInterface {

	public function all();
	public function findById($id);
	public function create(array $attributes);
	public function update(object $model, array $attributes);
	public function delete($id);

}