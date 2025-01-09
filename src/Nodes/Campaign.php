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

    public function addSlashPrice($params = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/add", [], $params);
    }

    public function updateSlashPrice($params = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/update", [], $params);
    }

    public function cancelSlashPrice($params = [])
    {
        return $this->post("/v1/slash-price/fs/:fs_id/cancel", [], $params);
    }

}
