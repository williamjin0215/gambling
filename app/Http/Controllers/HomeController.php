<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Affiliate;

class HomeController extends Controller
{
    public function index()
    {
        $file_name = env('AFFILIATES_FILE', 'affiliates.txt');
        $office_latitude = env('OFFICE_LATITUDE', 0);
        $office_longitude = env('OFFICE_LONGITUDE', 0);

        try {
            $contents = Storage::disk('local')->get($file_name);
            $affiliates = preg_split("/\r\n|\n|\r/", $contents);
            $response = array();
            
            foreach($affiliates as $row) {
                $data = json_decode($row, true);
                $affiliate = new Affiliate($data['affiliate_id'], $data['name'], $data['latitude'], $data['longitude']);
                if ($affiliate->calculateDistance($office_latitude, $office_longitude) < 100) {
                    array_push($response, $data);
                }
            }

            usort($response, function($a, $b) {
                return $a['affiliate_id'] <=> $b['affiliate_id'];
            });

            return view('home', ['data' => $response]);
        } catch (Illuminate\Contracts\FileSystem\FileNotFoundException $exception) {
            die("The file does not exist");
        }
    }
}
