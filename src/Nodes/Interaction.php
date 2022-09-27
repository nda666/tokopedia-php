<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\InteractionInterface;
use TokopediaPhp\NodeAbstract;

class Interaction extends NodeAbstract implements InteractionInterface
{
    /**
     * This endpoint retrieves a list of all messages (chatrooms) owned by a shop_id.
     *
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getListMessage($params = [])
    {
        return $this->get("/v1/chat/fs/:fs_id/messages", $params);
    }

    /**
     * This endpoint retrieves a list of all replies (chat bubble) for a msg_id which is owned by a shop_id.x
     *
     * @param  int   $msgId  Message service unique identifier
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function getListReply($msgId, $params)
    {
        return $this->get("/v1/chat/fs/:fs_id/messages/$msgId/replies", $params);
    }

    /**
     * This endpoint check if chat message exists, if it doesn’t, creates a new message. The response consists of a list of replies in a message status.
     *
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function getInitiateChat($params = [])
    {
        return $this->get("/v1/chat/fs/:fs_id/initiate", $params);
    }

    /**
     * This endpoint sends a reply to a message (chat room) identified by msg_id from shop_id.
     *
     * @param  int   $msgId  Message service unique identifier
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function sendReply($msgId, $params)
    {
        return $this->post("/v1/chat/fs/:fs_id/messages/$msgId/reply", $params);
    }
}
