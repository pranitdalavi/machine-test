<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Personaldetail;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Rap2hpoutre\FastExcel\FastExcel;
use Stevebauman\Location\Facades\Location;

class TestController extends Controller
{
    //Create form blade
    public function createForm(Request $request)
    {
        $personalDetailList = Personaldetail::all();
        $personalDetails = $request->id ? Personaldetail::find($request->id) : '';

        return view('create_form',['personalDetailList'=>$personalDetailList,'personalDetails'=>$personalDetails]);
    }

    //Store form data
    public function storePersonalDetails(Request $request)
    {
        $startTime = microtime(true);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $personalDetail = new Personaldetail();
        $id = $request->id;

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; 

        $personalDetail->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'execution_time' => $executionTime,
            ]
        );

        return back()->with('message',"Data saved successfully.");
    }

    //Delete personal details
    public function deletePersonalDetails($id)
    {
        $personalDetail = Personaldetail::find($id);
        $personalDetail->delete();
        return back()->with('delete-message',"Data deleted Successfully.");
    }

    //E-mail form blade
    public function publicIpAddress()
    {
        return view('public_ip_address');
    }

    public function IpAddress(Request $request)
    { 
        $requestIpAddress = $request->ip_address;
        $ip = $requestIpAddress ? $requestIpAddress : trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $ipAddressDetails = Location::get($ip);
        return $ipAddressDetails;
    }

    //E-mail form blade
    public function getRecords()
    {
        return view('get_records');
    }

    //Store form data
    public function storeRecords(Request $request)
    {
        $client = new Client();
        $response = $client->get('https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json');

        $response = $response->getBody()->getContents();


        $dataArray = json_decode($response, true);

        function getIds($data, &$ids)
        {
            foreach ($data as $key => $value) {
                if ($key === 'id') {
                    $ids[][] = $value;
                } elseif (is_array($value) || is_object($value)) {
                    getIds($value, $ids);
                }
            }
        }

        $uniqueIds[][] = 'Unique IDs';
        $uniqueIds[][] = '';

        getIds($dataArray, $uniqueIds);


        $ids = collect($uniqueIds);

        return fastexcel($ids)->download("unique_ids" . '.xlsx');
    }


    //E-mail form blade
    public function emailForm()
    {
        return view('sendmail');
    }

    //Store form data
    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $mailData = $request->all();

        Mail::to($mailData['email'])->send(new SendEmail($mailData));

        return back()->with('message',"E-mail sent successfully.");
    }

}
