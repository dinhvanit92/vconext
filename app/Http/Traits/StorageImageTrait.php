<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


trait StorageImageTrait
{
    public function storageUpload($request, $fieldName, $foderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $filenameOrigin = $file->getClientOriginalName();
            $name = explode('.', $file->getClientOriginalName());
            $newname = array_slice($name, 0, 1);
            $strname = implode(' ', $newname);
            $filenameHash = Str::slug($strname) . '-' . date("Y-m-d-h-m-s", time()) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $foderName, $filenameHash);
            $dataUpload = [
                'file_name' => $filenameOrigin,
                'file_path' => asset(Storage::url($filePath))
            ];
            return $dataUpload;
        }
        return null;
    }
}
