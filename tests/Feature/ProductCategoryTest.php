<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductCategoryTest extends TestCase {

	public function test_store() {
		$this->post("api/categories", [])->assertStatus(400);
		$this->post("api/categories", ['name' => 'test category 1'])->assertStatus(201);
		$this->post("api/categories", ['name' => 'test category 2'])->assertStatus(201);
		$this->post("api/categories", ['name' => 'test category 3'])->assertStatus(201);
	}

	public function test_update() {
		$this->patch("api/categories/1", [])->assertStatus(400);//for validate
		$this->patch("api/categories/100", ['name' => 'test not found id'])->assertStatus(404);//not found id
		$this->patch("api/categories/1", ['name'   => 'test category update'])->assertStatus(200);//update

	}

	public function test_index() {

		$this->get("api/categories")->assertStatus(200)->assertSuccessful();
	}

	public function test_show() {
		$this->get("api/categories/100")->assertStatus(404);//not found id
		$this->get("api/categories/1")->assertStatus(200)->assertSuccessful();
	}

	public function test_destroy() {
		$this->delete("api/categories/100")->assertStatus(404);//not found id
		$this->delete("api/categories/1")->assertStatus(204);
	}
}
