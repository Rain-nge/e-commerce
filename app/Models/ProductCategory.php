<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {
	use HasFactory;

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public static function boot() {
		parent::boot();

		self::deleting(function (ProductCategory $category) {

				foreach ($category->products as $product) {
					$product->delete();
				}
			});
	}

	public function products() {
		return $this->hasMany(Product::Class , 'category_id', 'id');
	}

}
