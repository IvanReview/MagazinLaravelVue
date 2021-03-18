<?php


namespace App\Repositories;


use App\Models\Currency;

class CurrencyConversion
{
    protected static $currency;
    protected static $currencies;
    const DEFAULT_CURRENCY_CODE = 'RUB';

    /**
     *
     */
    public static function loadCurrencies()
    {
        if (is_null(self::$currencies)){
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$currencies[$currency->code] = $currency;
            }
        }
    }

    /**
     *
     * Главный метод конвертации валют
     * @param null $targetCurrencyCode
     * @param string $originCurrencyCode
     * @return float|int
     */
    public static function convert($targetCurrencyCode = null, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE )
    {
        //получение текущей валюты
        $originCurrency = Currency::byCode($originCurrencyCode)->first();

        //получение целевой валюты
        $targetCurrency = Currency::byCode($targetCurrencyCode)->first();

        self::$currency = $targetCurrency;
        self::loadCurrencies();


        return  $originCurrency->rate * $targetCurrency->rate;
    }

    /**
     * Получение символа валюты
     * @param $currency
     * @return mixed
     */
    public static function getCurrencySymbol($currency)
    {
        return self::$currency->symbol;

    }

    /**
     * Код главной валюты
     * @return string
     */
    public static function getBaseCurrencyCode()
    {
        return self::DEFAULT_CURRENCY_CODE;

    }


    /**
     * Получение всех валют
     * @return mixed
     */
    public static function getCurrencies()
    {
        self::loadCurrencies();
        return self::$currencies;
    }

}
