<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Services\CartItemService;

class CartItemController extends Controller {

	/**
	 * @var $cartItemService
	 */
	protected $cartItemService;

	public function __construct(CartItemService $cartItemService) {

		$this->cartItemService = $cartItemService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return $this->cartItemService->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreCartItemRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCartItemRequest $request) {

		return $this->cartItemService->create($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		return $this->cartItemService->findById($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateCartItemRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCartItemRequest $request, $id) {
		return $this->cartItemService->update($id, $request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {

		return $this->cartItemService->delete($id);
	}
}
