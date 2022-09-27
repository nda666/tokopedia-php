<?php

namespace TokopediaPhp\Interfaces;

interface CategoryInterface
{
    /**
     *This endpoint retrieves a list of all categories and its children.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/category-api/get-all-categories
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getAllCategories($params);
}
