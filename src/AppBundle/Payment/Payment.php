<?php
/**
 * Created by PhpStorm.
 * User: rgrisot
 * Date: 21/02/17
 * Time: 15:14
 */

namespace AppBundle\Payment;
use ProductBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

class Payment
{
    const MODE = 'dev';
    private $server_paypal;
    private $api_paypal;
    private $user;
    private $password;
    private $signature;
    private $version;
    private $cancelUrl;
    private $returnUrl;

    public function __construct()
    {
        if(Payment::MODE === 'dev'){
            $this->server_paypal = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
            $this->api_paypal = 'https://api-3t.sandbox.paypal.com/nvp?';
            $this->user = 'grisot.remi-facilitator_api1.gmail.com';
            $this->password = 'QZLEL69NWCF6QUGE';
            $this->signature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31Ab6nocvqRHaMJv1ybVoYzIrz8WGl';
            $this->version = 204;
            $this->cancelUrl = 'http://127.0.0.1/cancel';
            $this->returnUrl = 'http://127.0.0.1/return';
        }
    }
    private function buildUrlPaypal(){
        return $this->api_paypal .(
            'VERSION='.$this->version
            .'&USER='.$this->user
            .'&PWD='.$this->password
            .'&SIGNATURE='.$this->signature
        );

    }

    private function getPaypalParams($results){
        $paramList = explode('&', $results);
        foreach ($paramList as $param){
            list($nom, $valeur) = explode('=', $param);
            $paypalParams['nom'] = urldecode($valeur);
        }
        return $paypalParams;
    }

    public function pay(Array $products){
        $request = $this->buildUrlPaypal();
        $request .= '&METHOD=SetExpressCheckout'
            .'&CANCELURL='.$this->cancelUrl
            .'&RETURNURL='.$this->returnUrl
            .'&AMT=';
    }
}