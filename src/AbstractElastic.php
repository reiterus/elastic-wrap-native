<?php

/*
 * This file is part of the Reiterus package.
 *
 * (c) Pavel Vasin <reiterus@yandex.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reiterus\ElasticWrap;

use Elasticsearch\Client;

/**
 * Class AbstractElastic
 *
 * @package Reiterus\ElasticWrap
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
abstract class AbstractElastic
{
    protected Client $client;

    /**
     * @param Client $client
     */
    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    /**
     * Get original client
     *
     * @return Client
     */
    public function client(): Client
    {
        return $this->client;
    }
}