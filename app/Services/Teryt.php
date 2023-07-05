<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Teryt
{
    /**
     * @var Client
     */
    private Client $HttpClient;

    /**
     * Controller
     */
    public function __construct()
    {
        $this->HttpClient = new Client([
            'base_uri' => env('TERYT_URL'),
            'headers' => [
                'Authorization' => 'Bearer ' . env('TERYT_TOKEN'),
                'Accept' => '*/*',
            ],
            'timeout' => 5.0,
            'verify' => false,
        ]);
    }

    /**
     * Retrieves data from the API
     *
     * @param string $uri
     *
     * @return false|array
     */
    private function getDataFromApi(string $uri): false|array
    {
        try {
            $response = $this->HttpClient->request('GET', $uri);

            return $this->validateResponse($response) ? json_decode($response->getBody(), true) : false;
        } catch (GuzzleException $e) {
            return false;
        }
    }

    /**
     * Checks if the response is correct
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    private function validateResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() === 200 && in_array('application/json', $response->getHeader('content-type'));
    }

    /**
     * Get all provinces
     *
     * @return array
     */
    public function getProvinces(): array
    {
        $response = $this->getDataFromApi('provinces');

        return $response ? $response['provinces'] : [];
    }

    /**
     * Get all provinces
     *
     * @return array
     */
    public static function provinces(): array
    {
        return (new Teryt)->getProvinces();
    }

    /**
     * Get a province by province ID
     *
     * @param string $provinceId
     *
     * @return array
     */
    public function getProvince(string $provinceId): array
    {
        $response = $this->getDataFromApi('provinces/' . $provinceId);

        return $response ? $response['provinces'] : [];
    }

    /**
     * Get a province by province ID
     *
     * @param string $provinceId
     *
     * @return array
     */
    public static function province(string $provinceId): array
    {
        return (new Teryt)->getProvince($provinceId);
    }

    /**
     * Get province districts by province ID
     *
     * @param string $provinceId
     *
     * @return array
     */
    public function getDistricts(string $provinceId): array
    {
        $response = $this->getDataFromApi('provinces/' . $provinceId . '/districts');

        return $response ? $response['districts'] : [];
    }

    /**
     * Get province districts by province ID
     *
     * @param string $provinceId
     *
     * @return array
     */
    public static function districts(string $provinceId): array
    {
        return (new Teryt)->getDistricts($provinceId);
    }

    /**
     * Get district by district ID
     *
     * @param string $districtId
     *
     * @return array
     */
    public function getDistrict(string $districtId): array
    {
        [$province, $district] = str_split($districtId, 2);
        $response = $this->getDataFromApi('provinces/' . $province . '/districts/' . $district);

        return $response ? $response['districts'][0] : [];
    }

    /**
     * Get district by district ID
     *
     * @param string $districtId
     *
     * @return array
     */
    public static function district(string $districtId): array
    {
        return (new Teryt)->getDistrict($districtId);
    }

    /**
     * Get district communes by district ID
     *
     * @param string $districtId
     *
     * @return array
     */
    public function getCommunes(string $districtId): array
    {
        [$province, $district] = str_split($districtId, 2);
        $response = $this->getDataFromApi('provinces/' . $province . '/districts/' . $district . '/communes/distinct');

        return $response ? $response['communes'] : [];
    }

    /**
     *  Get district communes by district ID
     *
     * @param string $districtId
     *
     * @return array
     */
    public static function communes(string $districtId): array
    {
        return (new Teryt)->getCommunes($districtId);
    }

    /**
     * Get commune by commune ID
     *
     * @param string $communeID
     *
     * @return array
     */
    public function getCommune(string $communeID): array
    {
        [$province, $district, $commune] = str_split($communeID, 2);
        $response = $this->getDataFromApi('provinces/' . $province . '/districts/' . $district . '/communes/' . $commune);

        return $response ? $response['communes'] : [];
    }

    /**
     *  Get commune by commune ID
     *
     * @param string $communeId
     *
     * @return array
     */
    public static function commune(string $communeId): array
    {
        return (new Teryt)->getCommune($communeId);
    }

    /**
     * Get commune cities by commune ID
     *
     * @param string $communeID
     *
     * @return array
     */
    public function getCities(string $communeID): array
    {
        [$province, $district, $commune] = str_split($communeID, 2);
        $response = $this->getDataFromApi('provinces/' . $province . '/districts/' . $district . '/communes/' . $commune . '/cities/');

        return $response ? $response['cities'] : [];
    }

    /**
     * Get commune cities by commune ID
     *
     * @param string $communeID
     *
     * @return array
     */
    public static function cities(string $communeID): array
    {
        return (new Teryt)->getCities($communeID);
    }

    /**
     * Get city by city ID
     *
     * @param $cityId
     *
     * @return array
     */
    public function getCity(string $cityId): array
    {
        $response = $this->getDataFromApi('cities/' . $cityId);

        return $response ? $response['cities'][0] : [];
    }

    /**
     * Get city by city ID
     *
     * @param string $cityId
     *
     * @return array
     */
    public static function city(string $cityId): array
    {
        return (new Teryt)->getCity($cityId);
    }

    /**
     * Get city streets by city ID
     *
     * @param string $cityId
     *
     * @return array
     */
    public function getStreets(string $cityId): array
    {
        $response = $this->getDataFromApi('cities/' . $cityId . '/streets');

        return $response ? $response['streets'] : [];
    }

    /**
     * Get city streets by city ID
     *
     * @param string $cityId
     *
     * @return array
     */
    public static function streets(string $cityId): array
    {
        return (new Teryt)->getStreets($cityId);
    }
}
