<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{


    // public function get_image_files(Request $request)
    // {
    //     $dir = "files"; // Your directory path

    //     $dir = public_path('upload/product');

    //     // Run the recursive function
    //     $response = $this->scan($dir);

    //     // Output the directory listing as JSON
    //     return response()->json([
    //         "name" => "files",
    //         "type" => "folder",
    //         "path" => $dir,
    //         "items" => $response
    //     ]);
    // }

    // private function scan($dir)
    // {
    //     $files = [];

    //     // Is there actually such a folder/file?
    //     if (File::exists($dir)) {
    //         $directory = File::allFiles($dir);

    //         foreach ($directory as $file) {
    //             $filePath = $file->getPathname();

    //             if ($file->isDir()) {
    //                 // The path is a folder
    //                 $files[] = [
    //                     "name" => $file->getFilename(),
    //                     "type" => "folder",
    //                     "path" => $filePath,
    //                     "items" => $this->scan($filePath) // Recursively get the contents of the folder
    //                 ];
    //             } else {
    //                 // It is a file
    //                 $files[] = [
    //                     "name" => $file->getFilename(),
    //                     "type" => "file",
    //                     "path" => $filePath,
    //                     "size" => $file->getSize() // Gets the size of this file
    //                 ];
    //             }
    //         }
    //     }

    //     return $files;
    // }



    public function get_image_files()
    {
        $directory = public_path('upload/product');

        if (File::isDirectory($directory)) {
            $items = File::allFiles($directory);
            $filesAndFolders = [];

            foreach ($items as $item) {
                if ($item->isFile()) {
                    // File
                    $filesAndFolders[dirname($item->getPath())]['files'][] = [
                        'name' => $item->getFilename(),
                        'type' => 'file',
                        'path' => $item->getPathname(),
                        'size' => $item->getSize(),
                    ];
                } else {
                    // Directory
                    $filesAndFolders[dirname($item->getPath())]['folders'][] = [
                        'name' => $item->getFilename(),
                        'type' => 'folder',
                        'path' => $item->getPathname(),
                    ];
                }
            }

            // return view('files', ['filesAndFolders' => $filesAndFolders]);

    $html = '';

    foreach ($filesAndFolders as $directory => $items){
        $html .='<h2>'.$directory.'</h2>';
        $html .='<ul>';
            if (isset($items['folders'])){
                $html .='<h3>Folders:</h3>';
                foreach ($items['folders'] as $folder){
                    $html .='<li>';
                    $html .='<strong>'.$folder['name'].'</strong> (Type: '.$folder['type'].')
                    </li>';
                }
            }

            if (isset($items['files'])){
                $html .='<h3>Files:</h3>';
                foreach ($items['files'] as $file){
                    $html .='<li>';
                    $html .='<strong>'.$file['name'].'</strong> (Type: '.$file['type'].', Size: '.$file['size'].')
                    </li>';
                }
            }
            $html .='</ul>';
        }

        echo $html;


        } else {
            return response()->json(['error' => 'Directory not found'], 404);
        }
    }


}
