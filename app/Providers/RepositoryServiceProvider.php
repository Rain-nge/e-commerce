<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	public function register() {

		$this->app->bind(
			'App\Interfaces\ProductCategoryInterface',
			'App\Repositories\ProductCategoryRepository'
		);

		$this->app->bind(
			'App\Interfaces\ProductInterface',
			'App\Repositories\ProductRepository'
		);

		$this->app->bind(
			'App\Interfaces\CartItemInterface',
			'App\Repositories\CartItemRepository'
		);

	}

}