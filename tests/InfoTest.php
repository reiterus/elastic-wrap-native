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
use Elasticsearch\Namespaces\CatNamespace;
use Elasticsearch\Namespaces\IndicesNamespace;
use Reiterus\ElasticWrap\Info;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Info
 * Class InfoTest
 *
 * @package Reiterus\ElasticWrap\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class InfoTest extends TestCase
{
    const COUNT_DOCS = 5;

    private Info $object;

    /**
     * @covers ::getIndices
     * @dataProvider indicesProvider
     * @return void
     */
    public function testGetIndices(array $list)
    {
        $actual = $this->object->getIndices($list);
        $this->assertIsArray($actual);
    }

    public function testGetCountDocs()
    {
        $actual = $this->object->getCountDocs('name');
        $this->assertIsInt($actual);
        $this->assertEquals(self::COUNT_DOCS, $actual);
    }

    public function testGetStats()
    {
        $actual = $this->object->getStats();
        $this->assertIsArray($actual);
    }

    public function testGetEmptyIndices()
    {
        $actual = $this->object->getEmptyIndices();
        $this->assertIsArray($actual);
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function emptyIndicesProvider(): array
    {
        return [
            [['qwe', 'asd', 'zxc']],
            [[]],
        ];
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function indicesProvider(): array
    {
        return [
            [['qwe', 'asd', 'zxc']],
            [[]],
        ];
    }

    /**
     * @codeCoverageIgnore
     * @return void
     */
    protected function setUp(): void
    {
        $cat = $this->getMockBuilder(CatNamespace::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cat->expects($this->any())
            ->method('count')
            ->withAnyParameters()
            ->willReturn([['count' => self::COUNT_DOCS]]);

        $cat->expects($this->any())
            ->method('indices')
            ->withAnyParameters()
            ->willReturn([['docs.count' => 'value', 'index' => 'value']]);

        $space = $this->getMockBuilder(IndicesNamespace::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stats = [
            '_shards' => [
                'successful' => 1,
            ],
            '_all' => [
                'primaries' => [
                    'docs' => [
                        'count' => 1,
                    ],
                    'store' => [
                        'size_in_bytes' => 1,
                    ],
                ]
            ],
        ];

        $space->expects($this->any())
            ->method('stats')
            ->withAnyParameters()
            ->willReturn($stats);

        $client = $this->getMockBuilder(ElasticClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client->expects($this->any())
            ->method('cat')
            ->withAnyParameters()
            ->willReturn($cat);

        $client->expects($this->any())
            ->method('indices')
            ->withAnyParameters()
            ->willReturn($space);

        $this->object = new Info($client);
    }
}
