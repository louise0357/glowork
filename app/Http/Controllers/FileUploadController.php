<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $rowId = $request->input('table_row_id');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $originalFileName = $file->getClientOriginalName();
            $fileName = $rowId . '_' . $originalFileName;

            $filePath = $file->storeAs('uploads', $fileName, 'public');

            return response()->json(['filePath' => $filePath], 200);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }


    public function getFiles($row_id)
    {
        $files = Storage::disk('public')->files('uploads');
        $filteredFiles = array_filter($files, function ($file) use ($row_id) {
            return strpos(basename($file), $row_id . '_') === 0;
        });

        return response()->json([
            'files' => array_map('basename', $filteredFiles)
        ]);
    }

    public function deleteFile(Request $request)
    {
        $fileName = $request->input('fileName');

        if (!preg_match('/^[a-zA-Z0-9_-]+\.[a-zA-Z0-9]{2,4}$/', $fileName)) {
            return response()->json(['error' => 'Geçersiz dosya adı formatı.'], 400);
        }

        $filePath = 'uploads/' . $fileName;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);

            return response()->json(['success' => 'Dosya başarıyla silindi.']);
        }

        return response()->json(['error' => 'Dosya bulunamadı.'], 404);
    }


}
