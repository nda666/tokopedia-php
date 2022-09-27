<?php

namespace TokopediaPhp\Interfaces;

interface LogisticInterface
{
    /**
     * This endpoint can retrieve all available shipment information
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/logistic-api/get-shipment-info
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getShipmentInfo($params = []);

    /**
     * This endpoint can retrieve active courier from related shop.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/logistic-api/get-active-courier
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getActiveCourier($params = []);

    /**
     * This endpoint can update seller shipment availability.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/logistic-api/update-shipment-info
     * @param  array $params
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function updateShipmentInfo($params = [], $body = []);
}
