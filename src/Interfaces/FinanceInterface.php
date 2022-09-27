<?php


namespace TokopediaPhp\Interfaces;

interface FinanceInterface
{
    /**
     * This endpoint returns seller saldo history from Shop ID that associated with FS ID.
     * This endpoint has two types of response as json format and files format with .xls extension
     * @param int $shopId
     * @param  array   $params
     * @param  boolean $returnResponse
     * @return \TokopediaPhp\ResponseData
     */
    public function getSaldoHistory($shopId, $params = []);
}
