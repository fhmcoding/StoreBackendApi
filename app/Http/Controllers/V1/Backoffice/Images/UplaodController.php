<?php

namespace App\Http\Controllers\V1\Backoffice\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use File;
class UplaodController extends Controller
{

    public function __invoke(Request $request)
    {
        if($request->hasFile('file')){
            $file= $request->file('file');
            $extension = $request->file->extension();
            $fileName = $file->getClientOriginalName();
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAs('/tmp'.'/',$fileName,['disk' => 'public']);

            TemporaryFile::create([
                'folder'=> '/',
                'filename' => $fileName,
                'extension'=>$extension,
            ]);
            return $fileName;
        }

        return '';
    }
}
