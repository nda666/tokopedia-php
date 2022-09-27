<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\CategoryInterface;
use TokopediaPhp\NodeAbstract;

class Category extends NodeAbstract implements CategoryInterface
{
    public function getAllCategories($params)
    {
        return $this->get("/inventory/v1/fs/:fs_id/product/category", $params);
    }
}
