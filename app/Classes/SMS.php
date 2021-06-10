<?php
	
namespace App\Classes;

use App\User;
use App\Http\Api\V1\Model\Device\Device;
use App\Http\Api\V1\Model\Message;
use App\Http\Api\V1\Model\MessageHistory;

class SMS {

    public static function send(Message $config,array $input)
    {
        //TODO: complete this sms function
        //REMARK: it is a function for log message and let them control the message content or target
        // STEP 1. get message config
        $content = $config->content;

        $toURL = "https://api3.hksmspro.com/service/smsapi.asmx/SendSMS";
        $post = array(
            "Username"=>"hubsmediahk",
            "Password"=>"hubsmediahk100",
            "Telephone"=>$input['phone_no'],
            "UserDefineNo"=>$input['user_define_no'],
            "Hex"=>"",
            "Message"=>$input['message'],
            "Sender"=>$config->sender
        );

        $ch = curl_init();
        $options = array(
            CURLOPT_URL=>$toURL,
            CURLOPT_HEADER=>0,
            CURLOPT_VERBOSE=>0,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_POST=>true,
            CURLOPT_SSL_VERIFYHOST=>false,
            CURLOPT_POSTFIELDS=>http_build_query($post),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);

        logging('SMS MSG RESPONSE',$result);

        $response = simplexml_load_string($result) or die("Error: Cannot create object");
        return [
            'state' => $response->State,
            'message' => $this->msg[(int)$response->State]
        ]; 
    }

    public function messageStatus(int $status){
        $msg = [
            0 => "Missing Values",
            1 => "Message Sent",
            10 => "Incorrect Username or Password",
            20 => "Message content too long",
            30 => "Message content too long",
            40 => "Telephone number too long",
            60 => "Incorrect Country Code",
            70 => "Balance not enough",
            80 => "Incorrect date time",
            100 => "System error, please try again",
        ];
        return $msg[$status];
    }
   
    public static function sendFCM($message, $id, $admin = false) {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $token 	 = $id;/*FCM 接收端的token*/
        $message = $message;         /*要接收的內容*/
        $title 	 = 'ECBento Message';  /*要接收的標題*/
        if($admin){
            $title 	 = 'Order Remind';  /*要接收的標題*/
        }
        // \Log::info('sending fcm');
        // \Log::info($id);
        $content = array
        (
            'title'	=> $title,
            'body' 	=> $message
        );

        $fields = array
        (
            'to'		    => $token,
            'notification'	=> $content
        );

        // \Log::info($id);
        $device = Device::where('fcm_token','like','%'.$id.'%')->orderBy('created_at','desc')->first();
        // \Log::info($device);
        // \Log::info($device->user);
        if($device){
            if($device->user){
                $msgHistory = MessageHistory::create([
                    'message_id'=>1,
                    'from_type' => 'App\Admin',
                    'from_id' => 1,
                    'to_type' => 'App\User',
                    'to_id' => $device->user->user_id,
                    'target' => $id,
                    'type' => 'fcm',
                    'content' => $message,
                ]);
                
                $fields = json_encode ( $fields );
            
                $headers = array (
                        'Authorization: key=' . "AAAAoS4cwhk:APA91bGeqGd8OgbrbDBNzk77YAxRjStQcFrEZNVc5lk-dDnO5gfMYKD9gk2z-LnKrtt-ATlTx1i3iae6pVsPphbz3sF42bNwqVlp-VBfSOoKBATRKz-iWJPA06s7lMSafUHfM88esAxn",
                        'Content-Type: application/json'
                );
            
                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
            
                $result = curl_exec ( $ch );
                // echo $result;
                curl_close ( $ch );
        
                $msgHistory->result = $result;
                $msgHistory->save();
            }
        }
        // dd($result);
    }

}
