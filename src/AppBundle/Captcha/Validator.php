<?php
/**
 * Created by PhpStorm.
 * User: rgrisot
 * Date: 19/05/17
 * Time: 14:51
 */

namespace AppBundle\Captcha;


use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

class Validator
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
    public function validateCaptcha($postedData, FormInterface $form = null){

        $datas = array(
            'secret' => $this->key,
            'response' => $postedData,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );
        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $reponse = curl_exec($ch);

        curl_close($ch);
        if($reponse === false){
            if($form != null){
                $form->addError(new  FormError('Captcha non valide'));
            }
            return false;
        }
        $reponse = json_decode($reponse);
        if(!$reponse->success){
            if($form != null){
                $form->addError(new  FormError('Captcha non valide'));
            }
            return false;
        }
        return true;

    }
}