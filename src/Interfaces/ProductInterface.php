<?php

namespace TokopediaPhp\Interfaces;

interface ProductInterface
{

    /**
     * This method will retrieve single product information either by product id
     * as parameter (choose one of those two parameters to use) from related fs_id.
     *
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getProducts($params = []);

    /**
     * This endpoint retrieves a list of variants related to a product_id.
     *
     * @param  int $productId
     * @return \TokopediaPhp\ResponseData
     */
    public function getProductVariantByProductId($productId);

    /**
     * This endpoint retrieves a list of variants related to a category_id. Use this API as main source to retrieve the newest category variant data.
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getProductVariantByCategoryId($params = []);

    /**
     * Endpoint used for creating new products.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function createProductV3($params = [], $body = []);

    /**
     * Endpoint used for bulk creating new products with maximum of 25 items.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function createProductV2($params = [], $body = []);

    /**
     * This is the new version of edit products endpoint.
     * This endpoint just need to pass field that needed to edit into payload request.
     * This endpoint can’t edit/update name for the product that already has a transaction.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function editProductV3($params = [], $body = []);

    /**
     * This endpoint is use to edit products endpoint.
     * This endpoint just need to pass field that needed to edit into payload request.
     * This endpoint can’t edit/update name for the product that already has a transaction.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function editProductV2($params = [], $body = []);

    /**
     * This endpoint is used for checking whether product creation/edit is successful,
     * to use this endpoint would have to obtain upload_id from create product endpoint or edit
     * product endpoint.
     *
     * @param int $upload_id
     * @param array $params
     * @return void
     */
    public function checkUploadStatus($uploadId, $params = []);

    /**
     * This endpoint use to set product into active without change product current stock.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function setActiveProduct($params = [], $body = []);

    /**
     * This endpoint use to set product into inactive without change product current stock.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function setInactiveProduct($params = [], $body = []);

    /**
     * This endpoint used for update product’s price.
     * You can update up to 100 products or SKUs in a single request to this endpoint.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function updatePriceOnly($params = [], $body = []);

    /**
     * This endpoint used for update product stock.
     * You can update up to 100 products or SKUs in a single request to this endpoint.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function updateStockOverwrite($params = [], $body = []);

    /**
     * This endpoint is used to update stock by increasing based on input value.
     * You can update up to 100 products or SKUs in a single request by using this endpoint.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function updateStockIncrement($params = [], $body = []);

    /**
     * This endpoint is used to update stock by decreasing based on input value.
     * You can update up to 100 products or SKUs in a single request by using this endpoint.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function updateStockDecrement($params = [], $body = []);

    /**
     * This endpoint use to delete product from a shop,
     * this endpoint could do bulk delete product by product_id.
     *
     * @param array $params
     * @param array $body
     * @return void
     */
    public function deleteProduct($params = [], $body = []);

    /**
     * This endpoint retrieves a list of all Discussion owned by a product_id,
     * shop_id needed for validate that product is owned by shop.
     *
     * @param array $params
     * @return void
     */
    public function getAllDiscussionProduct($params = []);

    /**
     * This endpoint retrieve list of product annotation (product specification) based on category ID.
     *
     * @param array $params
     * @return void
     */
    public function getProductAnnotationByCategoryId($params = []);
}
