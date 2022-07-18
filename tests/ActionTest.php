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

use Elasticsearch\Namespaces\IndicesNamespace;
use Elasticsearch\Client as ElasticClient;
use Reiterus\ElasticWrap\Action;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Action
 * Class ActionTest
 *
 * @package Reiterus\ElasticWrap\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class ActionTest extends TestCase
{
    private Action $object;

    /**
     * @covers ::deleteEmptyIndices
     * @dataProvider dataProvider
     * @return void
     */
    public function testDeleteEmptyIndices(array $indices)
    {
        $actual = $this->object->deleteEmptyIndices($indices);

        if (!count($indices)) {
            $this->assertNull($actual);
            return;
        }

        $this->assertIsInt($actual);
        $this->assertEquals(3, $actual);
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [['name_01', 'name_02', 'name_03']],
            [[]],
        ];
    }

    /**
     * @codeCoverageIgnore
     * @return void
     */
    protected function setUp(): void
    {
        $space = $this->getMockBuilder(IndicesNamespace::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client = $this->getMockBuilder(ElasticClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client->expects($this->any())
            ->method('indices')
            ->withAnyParameters()
            ->willReturn($space);

        $client->expects($this->any())
            ->method('delete')
            ->withAnyParameters()
            ->willReturnSelf();

        $this->object = new Action($client);
    }
}
