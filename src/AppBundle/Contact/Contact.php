<?php
/**
 * Created by PhpStorm.
 * User: rgrisot
 * Date: 11/05/17
 * Time: 09:04
 */

namespace AppBundle\Contact;


use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

class Contact
{


    public function validateForm(FormInterface $form):array{
        $datas = $form->getData();
        $sanitizedDatas = array();

        foreach ($datas as $key=>$data){
            if($key === 'email'){
                if($data == null or !($value = $this->validateEmail($data))){
                    $form->get('email')->addError(new FormError($key.' is not valid'));
                }
            }
            else if($key === 'userType' or $key === 'gender'){
                if($key ==='userType'){
                    $allowedValues = ['customer', 'producer', 'press', 'professional'];
                }else{
                    $allowedValues = ['m', 'f'];
                }
                if($data == null or !($value = $this->validateSelect($data, $allowedValues))){
                    $form->get($key)->addError(new FormError($key.' is not valid'));
                }
            }
            else{
                if($data == null or !$value = $this->validateString($data)){
                    $form->get('email')->addError(new FormError($key.' is not valid'));
                }
            }
            if(isset($value)){
                $sanitizedDatas[$key] = $value;
            }

        }
        return $sanitizedDatas;
    }
    /**
     * @param string $text
     * @return string|bool
     */
    private function validateString(string $text):string{
        return (filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS) === false
        or empty(trim($text)))?false:$text;
    }

    /**
     * @param string $mail
     * @return string|bool
     */
    private function validateEmail(string $mail) {
        return (($email = filter_var($mail, FILTER_SANITIZE_EMAIL)) === false or
        filter_var($email, FILTER_VALIDATE_EMAIL) === false
        or empty(trim($email)))?false:$email;
    }

    /**
     * @param string $choice
     * @param array $choices
     * @return string|bool
     */
    private function validateSelect(string $choice, array $choices):string{
        return in_array($choice, $choices)?$choice:false;
    }
}