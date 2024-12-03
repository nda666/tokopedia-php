<?php

namespace TokopediaPhp\Interfaces;

interface OrderInterface
{
    /**
     * This endpoint retrieves all orders for your shop between given timestamps
     * and the orders that already hit Payment Verified (220) Status
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/get-all-order
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getAllOrders($params = []);


    /**
     * This endpoint retrieves single orders for your shop between given order id or
     * invoice ref number
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/get-single-order
     *
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getSingleOrder($params = []);

    /**
     * This endpoint is return html page that can be use to print shipping label
     * for specific order. Shipping label can be seen after order status is on
     * process (400).Shipping label contain Booking Code as barcode that can be
     * scanned by Third-Party Logistic for automatic AWB
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/get-shipping-label
     *
     * @param int $orderId
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     * @link https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/get-shipping-label
     */
    public function getShippingLabel($orderId, $params = []);

    /**
     * Acknowledge the order (fully or partially accept the order)
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/accept-order
     * @param int $orderId
     * @return \TokopediaPhp\ResponseData
     */
    public function acceptOrder($orderId);

    /**
     * Negative acknowledge the order (reject the order)
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/reject-order
     * @param int $orderId
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function rejectOrder($orderId, $body = []);

    /**
     * This endpoint updates the order status of an order_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/confirm-shipping
     * @param int $orderId
     * @return \TokopediaPhp\ResponseData
     */
    public function updateOrderStatus($orderId, $body = []);

    /**
     * You can request pick up using this endpoint
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/request-pickup
     * @param array $body
     * @return \TokopediaPhp\ResponseData
     */
    public function requestPickUp($body = []);

    /**
     * Courier Online Booking (COB) and Call On Delivery (COD) endpoint is used
     * to get order data related to shipping process, especially when using Booking
     * Code and/or Payment Amount COD. This endpoint can use to get order by order ID,
     * get orders by Shop ID, or get orders by warehouse ID
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/cob-cod
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getFulfillmentOrder($params = []);

    /**
     * This endpoint is used to get resolution ticket by shop_id
     * https://developer.tokopedia.com/openapi/guide/api-reference/tokopedia/order-api/get-resolution-ticket
     * @param array $params
     * @return \TokopediaPhp\ResponseData
     */
    public function getResolutionTicket($params = []);
}
