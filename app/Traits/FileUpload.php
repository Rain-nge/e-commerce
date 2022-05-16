<?php
namespace App\Traits;

use Storage;
/**
 * summary
 */
trait FileUpload {
	/**
	 * summary
	 */
	public

function moveFile($filePath, $file) {

		$this->makeDirectory($filePath);

		$fileName = uniqid().time().'.'.$file->getClientOriginalExtension();
		$file->storeAs($filePath, $fileName, 'local');
		return $fileName;
	}

	public function makeDirectory($directory) {
		if (!Storage::disk('local')->exists($directory)) {
			Storage::disk('local')    ->makeDirectory($directory, 0777, true, true);
		}
	}

	public function removeExistingFile($directory) {
		if (Storage::disk('local')->exists($directory)) {
			Storage::disk('local')   ->delete($directory);
		}
	}
}