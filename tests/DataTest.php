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
use Reiterus\ElasticWrap\Data;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Data
 * Class DataTest
 *
 * @package Reiterus\ElasticWrap\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class DataTest extends TestCase
{
    private Data $object;

    /**
     * @covers ::getAllDocs
     * @return void
     */
    public function testGetAllDocs()
    {
        $actual = $this->object->getAllDocs('name');
        $this->assertIsArray($actual);
    }

    /**
     * @covers ::getChunkDocs
     * @return void
     */
    public function testGetChunkDocs()
    {
        $actual = $this->object->getChunkDocs('name');
        $this->assertIsArray($actual);
    }

    /**
     * @covers ::getFirstDoc
     * @return void
     */
    public function testGetFirstDoc()
    {
        $actual = $this->object->getFirstDoc('name');
        $this->assertIsArray($actual);
    }

    /**
     * @covers ::getLastDoc
     * @return void
     */
    public function testGetLastDoc()
    {
        $actual = $this->object->getLastDoc('name');
        $this->assertIsArray($actual);
    }

    /**
     * @codeCoverageIgnore
     * @return void
     */
    protected function setUp(): void
    {
        $client = $this->getMockBuilder(ElasticClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client->expects($this->any())
            ->method('search')
            ->withAnyParameters()
            ->willReturn(['key' => 'value']);

        $this->object = new Data($client);
    }
}
