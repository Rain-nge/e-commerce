<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'price', 'category_id', 'image'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	/**
	 * Interact with the product's price.
	 *
	 * @param  integer  $value
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	// protected function price(): Attribute
	// {
	//     return Attribute::make(
	//         get: fn ($value) => $value/100,
	//         set: fn ($value) => $value*100,
	//     );
	// }

	/**
	 * Set the price.
	 *
	 * @param  float|integer  $value
	 * @return void
	 */
	public function setPriceAttribute($value) {
		$this->attributes['price'] = intval($value*100);
	}

	/**
	 * Get the price
	 *
	 * @param  integer  $value
	 * @return float|integer
	 */
	public function getPriceAttribute($value) {
		return ($value/100);
	}

	public function productCategory() {
		return $this->belongsTo(ProductCategory::Class , 'category_id', 'id');
	}

}
