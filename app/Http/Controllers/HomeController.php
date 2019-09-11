<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Sns\SnsClient;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mail;
use PDF;
use App;
use App\Http\Requests;
use App\RegisteredUsers;

class HomeController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function registerView()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'mobile' => 'required',
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return array('success' => false, 'message' => $validation->errors());
        }else {
            $name = ucwords($request->get('name'));
            $email = $request->get('email');
            $mobile = "+44".$request->get('mobile');
            $mobile = $mobile;
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->mobile = $mobile;
            if ($request->get('search')) {
                $user->address = $request->get('search');
            } else {
                $address = '';
            }
            if ($request->get('model_no')) {
                $user->model_no = $request->get('model_no');
            }
            if ($request->get('windows_no')) {
                $user->windows_no = $request->get('windows_no');
            }
            if ($request->get('doors_no')) {
                $user->doors_no = $request->get('doors_no');
            }
            if ($request->get('license')) {
                $user->license = $request->get('license');
            } else {
                $license = '';
            }

            $emailPin = bcrypt(microtime());
            $emailPin = preg_replace('/[^A-Za-z0-9\-]/', '', $emailPin);
            $user->emailConfirmPin = $emailPin;

            $smsPin = bcrypt(microtime());
            $smsPin = preg_replace('/[^A-Za-z0-9\-]/', '', $smsPin);
            $user->smsConfirmPin = $smsPin;

            // Generate Pdf
            $this->generatePdf($name);

            $url = App::make('url')->to('/confirm/email/'.$emailPin);
            $smsPinUrl = App::make('url')->to('/confirm/sms/'.$smsPin);
            // Send Email
            $data = array(
                'email' => $email,
                'pin' => $url,
                'mobile' => $mobile
            );
            $date = date("Y-m-d H:i:s");
            $date_format = strtoupper(date('d F Y', strtotime($date)));
            $pdf_name = "README  " . $date_format . '.pdf';
            $parameters = array(
                'sender_name' => 'Smart Ready',
                'sender_email' => 'noreply@smartready.com',
                'subject' => 'Registration',
                'pdf_name' => $pdf_name,
                'pdf_to_attach' => 'test.pdf',
                'recipient' => $email
            );
            $emailTemplate = 'register_template';
            $this->sendEmail($data, $parameters, $emailTemplate);

            // Send Sms
            $message = "Done! You’re ready to convert. This number will be used to contact you! http://www.smartready.com/countdown . Confirm Pin is " . $smsPinUrl;
            $this->sendSMS($mobile, $message);
            $data = array('success' => true);
            // save the User to Database
            $user->save();
            return $data;
        }
    }

    public function confirmRegister(Request $request, $type = null, $pin = null){
        if($type == 'sms'){
            $fieldCheck = 'smsConfirmPin';
            $fieldUpdate = 'smsConfirm';
            $fieldGet = 'emailConfirm';
            $text = 'Email';
            $type = 'Phone Number';
        }else{
            $fieldCheck = 'emailConfirmPin';
            $fieldUpdate = 'emailConfirm';
            $fieldGet = 'smsConfirm';
            $text = 'Phone Number';
        }
        $user = User::where($fieldCheck, $pin)->first();
        if($user){
            $data = array(
                $fieldUpdate => 'Yes'
            );
            User::where($fieldCheck, $pin)->update($data);
            if($user->$fieldGet == 'Yes'){
                $message = ('Thank you for confirming ' .ucwords($type));
                return view('confirmPage', ['message1' => $message],['message2'=> ""]);
            }else{
                $message1 = 'Thank you for confirming ' .ucwords($type). '.';
                $message2 = 'Please confirm your ' . $text;
                // $message = nl2br($message, true);
                return view('confirmPage', ['message1' => $message1], ['message2' =>$message2]);
            }
        }else{
            $message = 'Invalid Pin';
            return view('confirmPage', ['message' => $message]);
        }
    }

    public function help()
    {
        return view('help');
    }

    public function business()
    {
        return view('business');
    }


    public function search()
    {
        // dd('===');
        return view('search.index');
    }

     public function swap()
    {
        return view('swap');
    }


    public function register()
    {
        return view('register.index');
    }

    public function app()
    {
        return view('app/index');
    }

     public function appsend()
    {
//        dd('============');
        return view('app/send');
    }

    public function learn()
    {
        return view('learn');
    }

    public function number0000()
    {
        return view('number/0000');
    }

    public function number1111()
    {
        return view('number/1111');
    }
    public function number2222()
    {
        return view('number/2222');
    }
    public function number3333()
    {
        return view('number/3333');
    }
    public function number4444()
    {
        return view('number/4444');
    }

    public function sendApp(Request $request)
    {
        $mobile = $request->get('mobileNumber');
        $code = $request->get('countryCode');
        $mobile = $code . $mobile;
        $message = "Scan using our app to register. Haven't got it? Download here http://www.smartready.com/download. Click here for online registration.";
        $this->sendSMS($mobile, $message);
        return redirect()->route('send');
    }

    /**
     *  Send SMS via AWS SNS
     */
    public function sendSMS($mobile_number, $message)
    {
        $mobile_number = str_replace(' ', '', $mobile_number);
        // send sms to mobile phone via AWS server
        $params = array(
            'version' => 'latest',
            'region' => 'eu-west-1',
            'credentials' => array(
                'key' => 'AKIAJ4DHAHZTOVYAWMRQ',
                'secret' => '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',
            ),
        );


        $sms = new \Aws\Sns\SnsClient($params);
//        dd($mobile_number);
        $args = array(
            'MessageAttributes' => [
                'AWS.SNS.SMS.SenderID' => [
                    'DataType' => 'String',
                    'StringValue' => 'SmartReady'
                ]
            ],
            "SMSType" => "Transactional",
            "Message" => $message,
            "PhoneNumber" => $mobile_number
        );
        return $sms->publish($args);
    }

    /**
     *  Send Email Via AWS SES
     */
    public function sendEmail($data, $parameters, $emailTemplate)
    {
        return $mail_sent = Mail::send('email.' . $emailTemplate, $data, function ($message) use ($parameters) {
            $message->from($parameters['sender_email'], $parameters['sender_name']);
            $message->replyTo($parameters['sender_email'], $parameters['sender_name']);
            $message->subject($parameters['subject']);
            $message->to($parameters['recipient']);
            if ($parameters['pdf_name'] !== '') {
                $message->attach(getcwd() . '/assets/pdf/'.$parameters['pdf_to_attach'], array(
                        'as' => $parameters['pdf_name'],
                        'mime' => 'application/pdf')
                );
            }
        });
    }

    public function generatePdf($name)
    {
        $html = '<h2 style="text-align: center ">Smart Ready </h2>'.
                '<br>'.
                '<span>'. $name.'</span>';
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return PDF::loadHTML($html)->save( public_path('assets/pdf/test.pdf'))->download('test.pdf');
    }

    public function register_email(Request $request){
        
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['sector'] = $request->sector;
        $data['currentDate'] = date('d, M Y');
        $data['currentTime'] = date('h:i:sa');
        $email = 'joshhawkes@outlook.com';
        $user_email = $data['email'];
        $parameters = array(
            'sender_name' => 'Smart Ready',
            'sender_email' => 'noreply@smartready.com',
            'subject' => 'Registration',
            'user_recipient' => $user_email
        );
        $input = array(
            'sector' => $data['sector'],
            'name' => $data['name'],
            'email' => $data['email'],
        );
        $inserted_data = RegisteredUsers::create($input);
        
        $this->send_user_register_email($data, $parameters);
        $parameters['recipient'] = $email;
        $this->send_register_email($data, $parameters);
        
        return 1;
    }

    public function send_user_register_email($data, $parameters){
        // dd($message);
        return $mail_sent = Mail::send('email.register_user', $data, function ($message) use ($parameters) {
            $message->from($parameters['sender_email'], $parameters['sender_name']);
            // $message->replyTo($parameters['sender_email'], $parameters['sender_name']);
            $message->to($parameters['user_recipient']);
            $message->subject($parameters['subject']);            
        });
    }

    public function send_register_email($data, $parameters){
        if($parameters['recipient']){
            return $mail_sent = Mail::send('email.register', $data, function ($message) use ($parameters) {
                $message->from($parameters['sender_email'], $parameters['sender_name']);
                // $message->replyTo($parameters['sender_email'], $parameters['sender_name']);
                $message->to($parameters['recipient']);
                $message->subject($parameters['subject']);            
            });
        }
    }

    public function verify(Request $request){
        $current_dir = trim(getcwd(), 'public');
        
        if(file_exists($current_dir.'resources/views/number/'.$request->search.'/index.blade.php')){
            $response = array(
                'number' => $request->search,
                'is_valid' => 1
            );
            return $response;
        }else{
            $response = array(
                'msg' => 'Sorry Number cannot be found.',
                'is_valid' => 0
            );
            return $response;
        }
    }

}
