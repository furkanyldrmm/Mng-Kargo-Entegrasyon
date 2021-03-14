<?php
namespace App\Http\MngKargo;
class CargoCreate{
    protected $username;
    protected $password;
    protected $keyship;
    protected $desi;
    protected $sender_name;
    protected $sender_city;
    protected $sender_region;
    protected $sender_address;
    protected $sender_mobile;
    protected $sender_taxnumber;
    protected $buyer_name;
    protected $buyer_city;
    protected $buyer_region;
    protected $buyer_address;
    protected $buyer_mobile;
    protected $buyer_taxnumber;
    protected $payer;
  

    
    public function __construct($Data)
    {
        $this->username = $Data['username'];
        $this->password = $Data['password'];
        $this->keyship = $Data['keyship'];
        $this->desi = $Data['desi'];
        $this->sender_name = $Data['sender_name'];
        $this->sender_city = $Data['sender_city'];
        $this->sender_region = $Data['sender_region'];
        $this->sender_address = $Data['sender_address'];
        $this->sender_mobile = $Data['sender_mobile'];
        $this->sender_taxnumber = $Data['sender_taxnumber'];
        $this->buyer_name = $Data['buyer_name'];
        $this->buyer_city = $Data['buyer_city'];
        $this->buyer_region = $Data['buyer_region'];
        $this->buyer_address = $Data['buyer_address'];
        $this->buyer_mobile = $Data['buyer_mobile'];
        $this->buyer_taxnumber = $Data['buyer_taxnumber'];
        $this->payer = $Data['payer'];
    }

    function SiparisKayitXML(){
        $response = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
          <SiparisKayit_C2C xmlns="http://tempuri.org/">
            <pKullaniciAdi>'.$this->username.'</pKullaniciAdi>
            <pSifre>'.$this->password.'</pSifre>
            <pSiparisNo>'.$this->keyship.'</pSiparisNo>
            <pBarkodText>'.$this->keyship.'</pBarkodText>
            <pIrsaliyeNo>'.$this->keyship.'</pIrsaliyeNo>
            <pUrunBedeli>0</pUrunBedeli>
            <pGonderiParcaList>
              <GonderiParca>
                <Kg>'.$this->desi.'</Kg>
                <Desi>'.$this->desi.'</Desi>
                <Adet>1</Adet>
                <Icerik>Ecza Ürünleri</Icerik>
              </GonderiParca>
            </pGonderiParcaList>
            <pGonderenMusteri>
              <pGonMusteriMngNo></pGonMusteriMngNo>
              <pGonMusteriBayiNo>1</pGonMusteriBayiNo>
              <pGonMusteriSiparisNo>'.$this->keyship.'</pGonMusteriSiparisNo>
              <pGonMusteriAdi>'.$this->sender_name.'</pGonMusteriAdi>
              <pGonMusAdresFarkli>0</pGonMusAdresFarkli>
              <pGonIlAdi>'.$this->sender_city.'</pGonIlAdi>
              <pGonilceAdi>'.$this->sender_region.'</pGonilceAdi>
              <pGonAdresText>'.$this->sender_address.'</pGonAdresText>
              <pGonSemt></pGonSemt>
              <pGonMahalle></pGonMahalle>
              <pGonMeydanBulvar></pGonMeydanBulvar>
              <pGonCadde></pGonCadde>
              <pGonSokak></pGonSokak>
              <pGonTelIs>'.$this->sender_mobile.'</pGonTelIs>
              <pGonTelEv>'.$this->sender_mobile.'</pGonTelEv>
              <pGonTelCep>'.$this->sender_mobile.'</pGonTelCep>
              <pGonFax></pGonFax>
              <pGonEmail></pGonEmail>
              <pGonVergiDairesi>'.$this->sender_region.'</pGonVergiDairesi>
              <pGonVergiNumarasi>'.$this->sender_taxnumber.'</pGonVergiNumarasi>
            </pGonderenMusteri>
            <pAliciMusteri>
              <pAliciMusteriMngNo></pAliciMusteriMngNo>
              <pAliciMusteriBayiNo>2</pAliciMusteriBayiNo>
              <pAliciMusteriAdi>'.$this->buyer_name.'</pAliciMusteriAdi>
              <pAliciMusAdresFarkli>0</pAliciMusAdresFarkli>
              <pAliciIlAdi>'.$this->buyer_city.'</pAliciIlAdi>
              <pAliciilceAdi>'.$this->buyer_region.'</pAliciilceAdi>
              <pAliciAdresText>'.$this->buyer_address.'</pAliciAdresText>
              <pAliciSemt></pAliciSemt>
              <pAliciMahalle></pAliciMahalle>
              <pAliciMeydanBulvar></pAliciMeydanBulvar>
              <pAliciCadde></pAliciCadde>
              <pAliciSokak></pAliciSokak>
              <pAliciTelIs>'.$this->buyer_mobile.'</pAliciTelIs>
              <pAliciTelEv>'.$this->buyer_mobile.'</pAliciTelEv>
              <pAliciTelCep>'.$this->buyer_mobile.'</pAliciTelCep>
              <pAliciFax></pAliciFax>
              <pAliciEmail></pAliciEmail>
              <pAliciVergiDairesi>'.$this->buyer_region.'</pAliciVergiDairesi>
              <pAliciVergiNumarasi>'.$this->buyer_taxnumber.'</pAliciVergiNumarasi>
            </pAliciMusteri>
            <pOdemeSekli>'.$this->payer.'</pOdemeSekli>
            <pTeslimSekli>Adrese_Teslim</pTeslimSekli>
            <pKargoCinsi>PAKET</pKargoCinsi>
            <pGondericiSms>0</pGondericiSms>
            <pAlSms>0</pAlSms>
            <pKapidaTahsilat>Mal_Bedeli_Tahsil_Edilmesin</pKapidaTahsilat>
            <pAciklama>NOVADAN</pAciklama>
          </SiparisKayit_C2C>
        </soap:Body>
      </soap:Envelope>';

        return $response;
    }

    function HeaderCreate($selectShipment){
        return  array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: ".strlen($selectShipment),
            "SOAPAction: http://tempuri.org/SiparisKayit_C2C",
            "Host: service.mngkargo.com.tr");
    }

}
