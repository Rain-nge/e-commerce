<?php
namespace App\Interfaces;

interface ProductInterface {

	public function all();
	public function findById($id);
	public function create(array $attributes);
	public function update(object $model, array $attributes);
	public function delete($id);

}