<?php


namespace App\Http\MngKargo;


class CargoCancel
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





    function CargoCancelXml(){
        $response='	<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		  <soap:Body>
		    <SiparisIptali_C2C xmlns="http://tempuri.org/">
		      <pKullaniciAdi>'.$this->username.'</pKullaniciAdi>
		      <pSifre>'.$this->password.'</pSifre>
		      <pSiparisNo>'.$this->keyship.'</pSiparisNo>
		    </SiparisIptali_C2C>
		  </soap:Body>
		</soap:Envelope>';


        return $response;
    }

    function HeaderCancel($selectShipment){
        return  array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: ".strlen($selectShipment),
            "SOAPAction: http://tempuri.org/SiparisIptali_C2C",
            "Host: service.mngkargo.com.tr"
        );
    }
}
