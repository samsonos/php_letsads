<?php
namespace samson\letsads;

use samson\core\iModuleCompressable;

class letSads extends \samson\core\Service implements iModuleCompressable
{
    protected $id = 'letsads';
    protected $sUrl  = 'http://letsads.com/api';

    public $module = 'letsads';
    public $login;
    public $password;

    public function beforeCompress(& $obj = null, array & $code = null)
	{
		
	}

    public function afterCompress( & $obj = null, array & $code = null )
	{
		
	}

    public function send($text, $phones = array('380634202325'), $from = 'Eloweb')
    {
        $auth ='<login>'.$this->login.'</login><password>'.$this->password.'</password>';
        $recipient = '';
        foreach($phones as $phone) {
            $recipient .= '<recipient>'.$phone.'</recipient>';
        }
        $sXML  = '<?xml version="1.0" encoding="UTF-8"?>
                    <request>
                        <auth>'.$auth.'</auth>
                        <message>
                            <from>'.$from.'</from>
                            <text>'.$text.'</text>'.$recipient.'
                        </message>
                    </request>';

        $rCurl = curl_init($this->sUrl);
        curl_setopt($rCurl, CURLOPT_HEADER, 0);
        curl_setopt($rCurl, CURLOPT_POSTFIELDS, $sXML);
        curl_setopt($rCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($rCurl, CURLOPT_POST, 1);
        $sAnswer = curl_exec($rCurl);
        curl_close($rCurl);
        //trace($sAnswer);
    }
}