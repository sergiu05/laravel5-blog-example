<?php

namespace Unicorn\Services;

use Carbon\Carbon;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadsManager {

	protected $disk;

	public function __construct() {

		$this->disk = Storage::disk(config('music-store.uploads.storage'));		

	}

	public function uploadFile(UploadedFile $file) {

		$newFileName = sha1(time().$file->getClientOriginalName().str_random(10)).".".$file->guessExtension();

		Storage::put($newFileName, file_get_contents($file->getRealPath()));
		
		return $newFileName;

	}
}