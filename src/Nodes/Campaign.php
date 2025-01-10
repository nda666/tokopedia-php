<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\CampaignInterface;
use TokopediaPhp\NodeAbstract;

class Campaign extends NodeAbstract implements CampaignInterface
{
    public function viewSlashPrice($params = [])
    {
        return $this->get("/v2/slash-price/fs/:fs_id/view", $params);
    }

    public function viewCampaignProducts($params = [])
    {
        return $this->get("/v1/campaign/fs/:fs_id/view", $params);
    }

    public function addSlashPrice($params = [], $body = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/add", $params, $body);
    }

    public function updateSlashPrice($params = [], $body = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/update", $params, $body);
    }

    public function cancelSlashPrice($params = [], $body = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/cancel", $params, $body);
    }

}
