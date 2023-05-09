<?php
namespace App\Feature\CurrencyConversion\Service\Providers;

use App\Feature\CurrencyConversion\Constants\FixerCurrencyHTTPCodeConstants;
use Exception;

class FixerCurrencyConversionProvider
{
    protected const BASE_URL = "https://api.apilayer.com/fixer/";

    protected const CONVERSION_ROUTE = "convert";

    protected const DEFAULT_EXCEPTION_MESSAGE = "Something Went Wrong";

    public function convert($amount, $from, $to) {
        $query = $this->createQueryForConversion($amount, $from, $to);
        return $this->processConversion($query);
    }

    protected function createQueryForConversion($amount, $from, $to) {
        $query = "?";
        $query .= "apikey=" . env('FIXER_API_KEY') . "&";
        $query .= "from=$from&";
        $query .= "to=$to&";
        $query .= "amount=$amount";
    }

    protected function processConversion($query) {
        $url = self::BASE_URL . self::CONVERSION_ROUTE . $query;
        $response = $this->executeGetRequest($url);
        $data = json_decode($response);
        
        if($data?->success && $data?->result) {
            return $data->result;
        } else {
            throw new Exception($data?->message ?? self::DEFAULT_EXCEPTION_MESSAGE);
        }
    }

    protected function executeGetRequest(string $url) {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
