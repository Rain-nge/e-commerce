<?php
namespace App\Traits;

/**
 * summary
 */
trait ServiceCustomMessage {
	/**
	 * summary
	 */
	public function idNotFound($id) {
		return 'ID '.$id.' doesn\'t found!';
	}
}