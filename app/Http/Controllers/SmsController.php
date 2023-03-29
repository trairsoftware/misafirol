<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SmsController extends Controller
{
    public function send(Request $request)
    {
        $result = $this->sendOTP($request->phone_number);
        $user = Auth::user();
        $userType = $user->is_institutional ? 'institutional' : 'individual';

        $errors = array(20,30,40,50,51,70,80,85,100,101);

        if (in_array($result, $errors)) {

            return view('home')->with('verified', 'sms')->with('errors', 'gsmError')->with('type', $userType);
        } else {
            return view('home')->with('verified', 'otp')->with('type', $userType);
        }
    }

    public function sendOTP($phone_number)
    {
        $otp = rand(100000, 999999);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
                <username>'. env('NETGSM_USER_CODE') . '</username>
                <password>'. env('NETGSM_PASSWORD') .'</password>
                <header>TRAIR TEKN.</header>
                <msg>Doğrulama Kodunuz: '. $otp .'</msg>
                <gsm>'. $phone_number .'</gsm>
                <filter>0</filter>
                <encoding>TR</encoding>
            </ns3:smsGonder1NV2>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);
        \Illuminate\Support\Facades\Session::put('OTP', $otp);
        \Illuminate\Support\Facades\Session::put( 'send_number', $phone_number);
        curl_close($curl);
        return $response;
    }

    public function sendSms($phone_number, $msg)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
                <username>'. env('NETGSM_USER_CODE') . '</username>
                <password>'. env('NETGSM_PASSWORD') .'</password>
                <header>TRAIR TEKN.</header>
                <msg>'. $msg .'</msg>
                <gsm>'. $phone_number .'</gsm>
                <filter>0</filter>
                <encoding>TR</encoding>
            </ns3:smsGonder1NV2>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function checkOtp(Request $request) {
        $inputOtp = $request->otp_key;
        $otp = $request->session()->get('OTP');
        $user = Auth::user();
        $userType = $user->is_institutional ? 'institutional' : 'individual';

        if ($inputOtp == $otp) {

            User::find(Auth::id())->update(['is_verified' => 1, 'phone_number' => $request->session()->get('send_number')]);
            \Illuminate\Support\Facades\Session::forget('OTP');
            \Illuminate\Support\Facades\Session::forget('send_number');
            return redirect('/');
        } else {
            return view('home')->with('verified', 'otp')->with('otp', 'wrong')->with('type', $userType);
        }
    }

    public function sendSmsToAllUsersByType(Request $request, $type) {

        $isAdmin = Auth::user()->type === 'admin';
        $isDev = false;

        if($isAdmin && $isDev) {

            if ($type === 'all') {

                $allUsersByType = User::all();
            } else {
                $allUsersByType = User::where('type', $type)->get();

            }

            foreach ($allUsersByType as $user) {
                $msg = '';

                switch ($type) {
                    case 'all':
                        $msg = 'Merhabalar, misafirol.org Sosyal Sorumluluk projesi olarak, elimizden gelen tüm imkanları 
                        kullandığımızı bildirmek isteriz. Gelişmeleri sms ile bildireceğiz, ayrıca bizlere +90 541 469 19 19 
                        numarasından da ulaşabilirsiniz.';
                    break;
                    case 'guest':
                        $msg = 'Merhaba, ihtiyaçlarınızı karşılayabilmeniz için sistemimizde ihtiyaç havuzu bölümü açılmıştır. İhtiyaçlarınızı  "İhtiyaç Havuzu" bölümüne ilan vererek bizlere ulaştırabilirsiniz.';
                    break;
                    case 'owner':
                        $msg = 'owner check'. $user->name;
                    break;
                }

                $this->sendSms($user->phone_number, $msg);
            }
        }else {
            return redirect('/');
        }
    }
}
