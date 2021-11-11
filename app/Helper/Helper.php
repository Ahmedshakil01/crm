<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Route;

class Helper
{
    public static function storagePath($filename)
    {
		// Path to the project's root folder
		//echo base_path();

		// Path to the 'app' folder
		//echo app_path();

		// Path to the 'public' folder
		//echo public_path();

		// Path to the 'storage' folder
		//echo storage_path();

		// Path to the 'storage/app' folder
		//echo storage_path('app');

		$imagepath = asset('uploads/product/thumnail/jpg/'.$filename);
        echo $imagepath;
    }

	 public static function isMobileDevice() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
		$_SERVER["HTTP_USER_AGENT"]);
	}



    /**
     * phones must be array without country code like the following
     * Helper::sendSMS(['01713311044', '01700223344'], 'this is a test SMS');
     */
    public static function sendSMS($phones=[], $smsText)
    {

        if( env('SMS_GATEWAY', 'SSL') == 'SSL' ){
            self::sendSmsViaSsl($phones, $smsText);
        }

        return true;

    }


    private static function sendSmsViaSsl($phones=[], $smsText) {

        $params = [
            "api_token" => env('SSL_SMS_API_TOKEN'),
            "sid" => env('SSL_SMS_SID'),
            "msisdn" => join(',',$phones),
            "sms" => $smsText,
            "batch_csms_id" => Helper::sslBatch('YmdHisu')
        ];
        $url = "https://smsplus.sslwireless.com/api/v3/send-sms/bulk";
        $params = json_encode($params);

        //echo callApi($url, $params);

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

	private static function sslBatch($format, $utimestamp = null)
    {
        $m = explode(' ',microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0]*1000,3));
        return date("YmdHis", $totalSeconds) . sprintf('%03d',$extraMilliseconds) . rand(11,99) ;
    }

       /*
          * this function is used for selecting the menu active class
          * @return active
      */

    public static function menuIsActive($routeNames)
    {
        $currentRoute = Route::currentRouteName();

        if (in_array($currentRoute, $routeNames)) {
            return 'active';
        }
    }
    public static function menuIsOpen($routeNames)
    {
        $currentRoute = Route::currentRouteName();

        if (in_array($currentRoute, $routeNames)) {
            return 'menu-open';
        }
    }

}
