<?php

/*
 * This file is part of the Reiterus package.
 *
 * (c) Pavel Vasin <reiterus@yandex.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reiterus\ElasticWrap\Tests;

use Elasticsearch\Client as ElasticClient;
use Reiterus\ElasticWrap\AbstractElastic;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::AbstractElastic
 * Class AbstractMakerTest
 *
 * @package Reiterus\ElasticWrap\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class AbstractElasticTest extends TestCase
{
    /**
     * @covers ::client
     * @return void
     */
    public function testClient()
    {
        $client = $this->getMockBuilder(ElasticClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $abstract = $this->getMockForAbstractClass(
            AbstractElastic::class,
            [
                'client' => $client
            ]
        );

        $this->assertInstanceOf(
            ElasticClient::class,
            $abstract->client()
        );
    }
}
