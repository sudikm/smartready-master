<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Sns\SnsClient;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mail;
use PDF;
use App;
use App\Http\Requests;

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

    public function join()
    {
        return view('join');
    }

    public function scan()
    {
        return view('scan');
    }

    public function scanSubmit(Request $request)
    {
        $mobile = $request->get('mobile');
        $code = $request->get('code');
        $mobile = $code . $mobile;
        $message = "Scan using our app to register. Haven't got it? Download here http://www.smartready.com/download. Click here for online registration.";
        $this->sendSMS($mobile, $message);
        return;
    }

    /**
     *  Send SMS via AWS SNS
     */
    public function sendSMS($mobile_number, $message)
    {
        $mobile_number = str_replace(' ', '', $mobile_number);
        // send sms to mobile phone via AWS server
        $params = array(
            'credentials' => array(
                'key' => 'AKIAJ4DHAHZTOVYAWMRQ',
                'secret' => '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',
            ),
            'region' => 'eu-west-1',
            'version' => 'latest'
        );
        $sms = new \Aws\Sns\SnsClient($params);
        $args = array(
            'MessageAttributes' => [
                'AWS.SNS.SMS.SenderID' => [
                    'DataType' => 'String',
                    'StringValue' => 'HUG'
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
}
