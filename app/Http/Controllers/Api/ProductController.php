<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller {

	/**
	 * @var $productService
	 */
	protected $productService;

	public function __construct(ProductService $productService) {

		$this->productService = $productService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return $this->productService->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductRequest $request) {

		return $this->productService->create($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		return $this->productService->findById($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProductRequest $request, $id) {

		return $this->productService->update($id, $request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {

		return $this->productService->delete($id);
	}
}
