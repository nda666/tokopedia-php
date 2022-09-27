<?php

namespace TokopediaPhp\Interfaces;

interface ShopInterface
{
    /**
     * This endpoint returns shop information from shop_id that associated with fs_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/get-shop-info
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getShopInfo($params = []);

    /**
     * This endpoint to update shop status into open or close
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/update-shop-status
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function updateShopStatus($params = []);

    /**
     * This endpoint used to get existing showcase based on shopID and FSID
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/get-showcase
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getShowcase($params = []);

    /**
     * This endpoint used to create new showcase based on shop_id and fs_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/create-showcase
     *
     * @param array $params
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function createShowcase($params = [], $body = []);

    /**
     * This endpoint used to update existing showcase based on showcase_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/update-showcase
     *
     * @param array $params
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function updateShowcase($params = [], $body = []);

    /**
     * This endpoint used to delete existing showcase based on showcase_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/shop-api/delete-showcase
     *
     * @param array $params
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function deleteShowcase($params = [], $body = []);
}
