<?php
namespace App\Http\MngKargo;


class MngComponent
{

    public $_debug = false;

    public function selectCargo()
    {///GelecekIadeSiparisKontrol fonksyonudur kargo durumu sorgular

        $url = 'http://service.mngkargo.com.tr/tservis/musterisiparisnew.asmx';

        /*
        $resultx[0]='35615719';//451820558
        $resultx[1]='356TST2425XGHPRFTG';//RYEJZQWV
        $resultx[2]=';//http://service.mngkargo.com.tr/musterikargosiparis/musterisiparisnew.asmx
        */
        $data = [
            "username" => "35615719",
            "password" => "356TST2425XGHPRFTG",
            "keyship" => "deneme76"
        ];
        $selectCargo = new CargoSelect($data);
        $selectShipment = $selectCargo->CargoSelectXml();
        $header = $selectCargo->HeaderSelect($selectShipment);
        $response = $this->curlInit($url, $selectShipment, $header);
        return $response;
    }


    public function cancelCargo()
    {///GelecekIadeSiparisIptali fonksyonudur kargo iptal eder
        $data = [
            "username" => "35615719",
            "password" => "356TST2425XGHPRFTG",
            "keyship" => "deneme76"
        ];

        $url = 'http://service.mngkargo.com.tr/tservis/musterisiparisnew.asmx';


        $cancelCargo = new CargoCancel($data);
        $selectShipment = $cancelCargo->CargoCancelXml();
        $header = $cancelCargo->HeaderCancel($selectShipment);
        $response = $this->curlInit($url, $selectShipment, $header);

        return $response;

    }

    public function createCargo()
    {///SiparisKayit_C2C fonksyonudur kargo siparişi oluşturur


        $data = [
            "username" => "35615719",
            "password" => "356TST2425XGHPRFTG",
            "keyship" => "deneme777",
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


    function checkCharakter($charim)
    {
        $bulunacak = array('ç', 'Ç', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'ö', 'Ş', 'ş', 'Ö', 'Ü', ',', ' ', '(', ')', '[', ']');
        $degistir = array('c', 'C', 'i', 'I', 'g', 'G', 'u', 'o', 'S', 's', 'O', 'U', '', ' ', '', '', '', '');
        $sonuc = str_replace($bulunacak, $degistir, $charim);
        return $sonuc;
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
