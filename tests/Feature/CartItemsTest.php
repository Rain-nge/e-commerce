<?php

namespace Tests\Feature;

use Tests\TestCase;

class CartItemsTest extends TestCase {

	public function test_store() {
		$this->post("api/cart-items", [])->assertStatus(400);
		$this->post("api/cart-items", ['product_id' => 2])->assertStatus(201);
		$this->post("api/cart-items", ['product_id' => 3])->assertStatus(201);
	}

	public function test_update() {
		$this->patch("api/cart-items/1", ['product_id'   => 'test'])->assertStatus(400);//for validate
		$this->patch("api/cart-items/100", ['product_id' => 2])->assertStatus(404);//not found id
		$this->patch("api/cart-items/1", ['product_id'   => 4])->assertStatus(200);//update
	}

	public function test_index() {

		$this->get("api/cart-items")->assertStatus(200)->assertSuccessful();
	}

	public function test_show() {
		$this->get("api/cart-items/100")->assertStatus(404);//not found id
		$this->get("api/cart-items/1")->assertStatus(200)->assertSuccessful();
	}

	public function test_destroy() {
		$this->delete("api/cart-items/100")->assertStatus(404);//not found id
		$this->delete("api/cart-items/1")->assertStatus(204);
	}
}
