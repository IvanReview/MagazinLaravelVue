<?php

namespace App\Repositories;


use Exception;
use GuzzleHttp\Client;

class CurrencyRates
{
    
    const ACCESS_KEY = '3db84840f00d3d4a820c0fcdf07c5eff';
    

    public static function getRates()
    {
        $baseCurrencyCode = CurrencyConversion::getBaseCurrencyCode();

        //ссылка на сервис газзл для получения данных (изменения базовую валюту задать нельзя на бесплатном тарифе)
        /*$url = config('currency_rates.api_url') . '?access_key='. self::ACCESS_KEY  . '&base=' . $baseCurrencyCode;*/
        $url = config('currency_rates.api_url') . '?access_key='. self::ACCESS_KEY ;

     
        // методыGuzzle
        $client = new Client();
        $response  =  $client->request('GET', $url);

        //если сервсис не работает
        if ($response->getStatusCode() !== 200) {
            throw new Exception('Проблема с сервисом валют');
        }
        //вменяемый вид ответа от сервера(валюты)
        $rates = json_decode($response->getBody()->getContents(), true)['rates'];



        foreach (CurrencyConversion::getCurrencies() as $currency){

            if (!$currency->isMain()) {//если валюта не главная
                if (!isset($rates[$currency->code])){//если она вообще существует в ответе от сервера валют
                    throw new Exception('Проблема с сервисом валют' . $currency->code);
                } else {
                    //обновляем валюты
                    $currency->update(['rate'=> $rates[$currency->code]]);
                    $currency->touch(); //обновляет время обновления записи
                }
            }
        }


    }


}
