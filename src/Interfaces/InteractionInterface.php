<?php

namespace TokopediaPhp\Interfaces;

interface InteractionInterface
{
    /**
     * This endpoint retrieves a list of all messages (chatrooms) owned by a shop_id.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/interaction-api/list-message
     * @param  array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getListMessage($params = []);

    /**
     * This endpoint retrieves a list of all replies (chat bubble) for a msg_id which is owned by a shop_id.x
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/interaction-api/list-reply
     * @param  int   $msgId  Message service unique identifier
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function getListReply($msgId, $params);

    /**
     * This endpoint check if chat message exists, if it doesn’t, creates a new message. The response consists of a list of replies in a message status.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/interaction-api/initiate-chat
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function getInitiateChat($params = []);

    /**
     * This endpoint sends a reply to a message (chat room) identified by msg_id from shop_id.
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/interaction-api/send-reply
     * @param  int   $msgId  Message service unique identifier
     * @param  array $params Body parameters
     * @return \TokopediaPhp\ResponseData
     */
    public function sendReply($msgId, $params);
}
