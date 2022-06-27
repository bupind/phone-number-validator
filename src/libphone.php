<?php


require __DIR__ . '/vendor/autoload.php';

use \libphonenumber\PhoneNumberUtil;
use \libphonenumber\PhoneNumberFormat;
use \libphonenumber\NumberParseException;

class libphone
{

    public function checkLibphone($isoCode, $phoneNumber)
    {


        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $NumberProto = $phoneUtil->parse($phoneNumber, $isoCode);
            $isValid     = $phoneUtil->isValidNumber($NumberProto);
            $type        = $phoneUtil->getNumberType($NumberProto);

            if (($isValid == true) && ($type == 1)) {
                $response['valid']   = 1;
                $response['message'] = $phoneUtil->format($NumberProto, PhoneNumberFormat::E164);
            } else {
                $response['valid']   = 0;
                $response['message'] = 'Please choose valid mobile number';
            }
            return $response;
        } catch (\libphonenumber\NumberParseException $e) {
            $response['valid']   = 0;
            $response['message'] = 'Invalid Number';
            return $response;
        }


    }
}
