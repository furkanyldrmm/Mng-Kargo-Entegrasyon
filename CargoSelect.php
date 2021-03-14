<?php


namespace App\Http\MngKargo;


class CargoSelect
{
    protected $username;
    protected $password;
    protected $keyship;



    public function __construct($Data)
    {
        $this->username = $Data['username'];
        $this->password = $Data['password'];
        $this->keyship  = $Data['keyship'];
    }





    function CargoSelectXml(){
        $response='
		<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			  <soap:Body>
			    <GelecekIadeSiparisKontrol xmlns="http://tempuri.org/">
			      <pRfSipGnMusteriNo>'.$this->username.'</pRfSipGnMusteriNo>
			      <pRfSipGnMusteriSifre>'.$this->password.'</pRfSipGnMusteriSifre>
			      <pChSiparisNo>'.$this->keyship.'</pChSiparisNo>
			    </GelecekIadeSiparisKontrol>
			  </soap:Body>
			</soap:Envelope>
		';

        return $response;
    }

    function HeaderSelect($selectShipment){
        return  array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: ".strlen($selectShipment),
            "SOAPAction: http://tempuri.org/GelecekIadeSiparisKontrol",
            "Host: service.mngkargo.com.tr");
    }

}
