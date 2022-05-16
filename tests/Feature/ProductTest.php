<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase {

	public function test_store() {
		$this->post("api/products", [])->assertStatus(400);
		$this->post("api/products",
			[
				'name'        => 'test product1',
				'price'       => 200.25,
				'category_id' => 2

			])->assertStatus(201);

		$this->post("api/products",
			[
				'name'        => 'test product2',
				'price'       => 300,
				'category_id' => 2

			])->assertStatus(201);

		$this->post("api/products",
			[
				'name'        => 'test product3',
				'price'       => 400.55,
				'category_id' => 3

			])->assertStatus(201);

	}

	public function test_update() {
		$this->patch("api/products/1", ['name'   => 'test product1'])->assertStatus(400);//for validate
		$this->patch("api/products/100", ['name' => 'test not found id'])->assertStatus(404);//not found id
		$this->patch("api/products/1", ['name'   => 'test product update'])->assertStatus(200);//update
	}

	public function test_index() {

		$this->get("api/products")->assertStatus(200)->assertSuccessful();
	}

	public function test_show() {
		$this->get("api/products/100")->assertStatus(404);//not found id
		$this->get("api/products/1")->assertStatus(200)->assertSuccessful();
	}

	public function test_destroy() {
		$this->delete("api/products/100")->assertStatus(404);//not found id
		$this->delete("api/products/1")->assertStatus(204);
	}
}
