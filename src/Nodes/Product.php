<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\ProductInterface;
use TokopediaPhp\NodeAbstract;

class Product extends NodeAbstract implements ProductInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundleList($params = [])
    {
        return $this->get("v1/products/bundle/fs/:fs_id/list", $params);
    }

    /**
     * {@inheritDoc}
     */
    public function getProducts($params = [])
    {
        return $this->get("inventory/v1/fs/:fs_id/product/info", $params);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductVariantByProductId($productId)
    {
        return $this->get("inventory/v1/fs/:fs_id/product/variant/$productId");
    }

    /**
     * {@inheritDoc}
     */
    public function getProductVariantByCategoryId($params = [])
    {
        return $this->get("/inventory/v2/fs/:fs_id/category/get_variant", $params);
    }

    /**
     * {@inheritDoc}
     */
    public function createProductV3($params = [], $body = [])
    {
        return $this->post("/v3/products/fs/:fs_id/create", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function createProductV2($params = [], $body = [])
    {
        return $this->post("/v2/products/fs/:fs_id/create", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function editProductV3($params = [], $body = [])
    {
        return $this->patch("/v3/products/fs/:fs_id/edit", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function editProductV2($params = [], $body = [])
    {
        return $this->patch("/v2/products/fs/:fs_id/edit", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function checkUploadStatus($uploadId, $params = [])
    {
        return $this->get("/v2/products/fs/:fs_id/status/:upload_id", $params);
    }

    /**
     * {@inheritDoc}
     */
    public function setActiveProduct($params = [], $body = [])
    {
        return $this->post("/v1/products/fs/:fs_id/active", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function setInactiveProduct($params = [], $body = [])
    {
        return $this->post("/v1/products/fs/:fs_id/inactive", $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function updatePriceOnly($params = [], $body = [])
    {
        return $this->post('/inventory/v1/fs/:fs_id/price/update', $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function updateStockOverwrite($params = [], $body = [])
    {
        return $this->post('/inventory/v1/fs/:fs_id/stock/update', $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function updateStockIncrement($params = [], $body = [])
    {
        return $this->post('/inventory/v2/fs/:fs_id/stock/increment', $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function updateStockDecrement($params = [], $body = [])
    {
        return $this->post('/inventory/v2/fs/:fs_id/stock/decrement', $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteProduct($params = [], $body = [])
    {
        return $this->post('/v3/products/fs/:fs_id/delete', $params, $body);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllDiscussionProduct($params = [])
    {
        return $this->get('/v1/discussion/fs/:fs_id/list', $params);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductAnnotationByCategoryId($params = [])
    {
        return $this->get('/v1/fs/:fs_id/product/annotation', $params);
    }
}
