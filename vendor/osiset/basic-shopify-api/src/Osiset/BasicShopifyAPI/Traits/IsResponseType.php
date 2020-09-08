<?php

namespace Osiset\BasicShopifyAPI\Traits;

use Psr\Http\Message\ResponseInterface;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;

/**
 * Determine GraphQL or REST response type.
 */
trait IsResponseType
{
    /**
     * Check if this is a REST request by sniffing headers.
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    protected function isRestResponse(ResponseInterface $response): bool
    {
        return $response->hasHeader(BasicShopifyAPI::HEADER_REST_API_LIMITS);
    }

    /**
     * Check if this is a GraphQL request by sniffing headers.
     *
     * @param ResponseInterface $response
     * @return boolean
     */
    protected function isGraphResponse(ResponseInterface $response): bool
    {
        return !$this->isRestResponse($response);
    }
}
