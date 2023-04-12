<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;

class SiteController extends Controller
{
    private $client;
    private $drive;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig('/path/to/your/client_secret.json');
        $this->client->setScopes([Drive::DRIVE_FILE]);
        $this->client->setAccessType('offline');
        $this->drive = new Drive($this->client);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if ($file->getClientOriginalExtension() !== 'zip' && $file->getClientOriginalExtension() !== 'rar') {
            return redirect()->back()->with('error', 'Only .zip or .rar files are allowed.');
        }

        if ($request->input('price') > 100) {
            return redirect()->back()->with('error', 'The maximum price allowed is 100 EUR.');
        }

        // Insert a file into the user's Google Drive
        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => $file->getClientOriginalName(),
            'parents' => array('folder-id'),
            'mimeType' => $file->getClientMimeType()
        ));

        $content = file_get_contents($file->getRealPath());
        $file = $this->drive->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => $file->getClientMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id'
        ));

        // Save the other form data to your database or redirect to a success page
        $title = $request->input('title');
        $genre = $request->input('genre');
        $price = $request->input('price');
        $about = $request->input('about');

        // ... save to database or redirect

        return redirect()->back()->with('success', 'Your file has been uploaded successfully.');
    }
}
