<?php

namespace TokopediaPhp\Interfaces;

interface CampaignInterface
{
    /**
     * This endpoint view all slash price campaign that already set.
     * 
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function viewSlashPrice($params = []);


    /**
     * This endpoint view all active campaigns from certain products.
     * 
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function viewCampaignProducts($params = []);

    /**
     * This endpoint add slash price campaign into product.
     * 
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function addSlashPrice($params = []);

    /**
     * This endpoint add slash price campaign into product.
     * 
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function updateSlashPrice($params = []);

    /**
     * This endpoint cancel slash price campaign that already be set.
     * 
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function cancelSlashPrice($params = []);

}
