<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {
	use HasFactory;

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['product_id'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public function product() {
		return $this->belongsTo(Product::Class , 'product_id');
	}

}
