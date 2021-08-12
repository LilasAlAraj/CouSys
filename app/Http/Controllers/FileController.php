<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FileController extends Controller
{
    //


    public function uploadForm()
    {
        return view('file-upload');
    }

    public function downloadForm()
    {
        return view('file-download');
    }

    public function removeForm()
    {
        return view('file-download');
    }


    public function fileRemove($fileID)
    {
        $file = File::where('fileID', $fileID)->delete();

    }

    public function fileDownload($fileID)
    {

        $file = File::where('fileID', $fileID)->firstOrFail();
        $pathToFile = storage_path($file->filePath);
        return Response::download($pathToFile);
    }


    public function fileUpload(Request $req)

    {

        $req->validate([

            // the maximum size of files is 10 mega which is 10*2^20
            // pptx is stand for power point files
            // docx is stand for word files
            'file' => 'required|mimes:zip,txt,pdf,pptx,docx |max:10485760‬'
        ]);

        $fileModel = new File;

        if ($req->file()) {
            $fileName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $req->file->getClientOriginalName();
            $fileModel->filePath = '/storage/' . $filePath;
            $fileModel->save();

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }


}
