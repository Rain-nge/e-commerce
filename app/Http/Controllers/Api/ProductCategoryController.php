<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller {

	/**
	 * @var $productCategoryService
	 */
	protected $productCategoryService;

	public function __construct(ProductCategoryService $productCategoryService) {

		$this->productCategoryService = $productCategoryService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return $this->productCategoryService->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductCategoryRequest $request) {

		return $this->productCategoryService->create($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		return $this->productCategoryService->findById($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProductCategoryRequest $request, $id) {

		return $this->productCategoryService->update($id, $request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {

		return $this->productCategoryService->delete($id);
	}
}
