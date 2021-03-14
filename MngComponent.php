<?php
namespace App\Http\MngKargo;


class MngComponent
{

    public $_debug = false;

    public function selectCargo()
    {

        $url = 'http://service.mngkargo.com.tr/tservis/musterisiparisnew.asmx';

      
        $data = [
            "username" => "username",
            "password" => "password",
            "keyship" => "12345"
        ];
        $selectCargo = new CargoSelect($data);
        $selectShipment = $selectCargo->CargoSelectXml();
        $header = $selectCargo->HeaderSelect($selectShipment);
        $response = $this->curlInit($url, $selectShipment, $header);
        return $response;
    }


    public function cancelCargo()
    {
        $data = [
            "username" => "username",
            "password" => "password",
            "keyship" => "12345"
        ];

        $url = 'http://service.mngkargo.com.tr/tservis/musterisiparisnew.asmx';


        $cancelCargo = new CargoCancel($data);
        $selectShipment = $cancelCargo->CargoCancelXml();
        $header = $cancelCargo->HeaderCancel($selectShipment);
        $response = $this->curlInit($url, $selectShipment, $header);

        return $response;

    }

    public function createCargo()
    {


        $data = [
            "username" => "username",
            "password" => "password",
            "keyship" => "1234",
            "desi" => 1,
            "sender_name" => "deneme",
            "sender_city" => "deneme",
            "sender_region" => "deneme",
            "sender_address" => "deneme",
            "sender_mobile" => "deneme",
            "sender_taxnumber" => "deneme",
            "buyer_name" => "deneme",
            "buyer_city" => "deneme",
            "buyer_region" => "deneme",
            "buyer_address" => "deneme",
            "buyer_mobile" => "deneme",
            "buyer_taxnumber" => "deneme",
            "payer" => "Platform_Odeyecek"
        ];
        $url = 'http://service.mngkargo.com.tr/tservis/musterisiparisnew.asmx';

        $newCargo = new CargoCreate($data);
        $selectShipment = $newCargo->SiparisKayitXML();

        $header = $newCargo->HeaderCreate($selectShipment);
        $response = $this->curlInit($url, $selectShipment, $header);
        return $response;
    }




    function curlInit($url, $selectShipment, $header)
    {
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 100);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 100);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $selectShipment);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($soap_do);
        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result);
        //$xml=$result;
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json, true);
        return $responseArray;
    }
}

?>
