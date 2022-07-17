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

use Reiterus\ElasticWrap\Contract\ActionInterface;

/**
 * Class Action
 *
 * @package Reiterus\ElasticWrap
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class Action extends AbstractElastic implements ActionInterface
{
    /**
     * Remove Empty Indexes
     *
     * @param array $indices
     *
     * @return int|null
     */
    public function deleteEmptyIndices(array $indices): ?int
    {
        if (!count($indices)) {
            return null;
        }

        $result = 0;

        foreach ($indices as $index) {
            $this->client
                ->indices()
                ->delete(['index' => $index]);

            $result++;
        }

        return $result;
    }

    /**
     * Get all index documents.
     * Warning! Only use this for small indexes!
     *
     * @param string $name
     *
     * @return array
     */
    public function getAllDocs(string $name): array
    {
        $params = [
            'index' => $name,
            'body' => [
                'query' => [
                    'match_all' => (object)[],
                ],
            ],
        ];

        return $this->client->search($params);
    }

    /**
     * Get some chunk index documents.
     *
     * @param string $name
     * @param int $size
     * @param string $sort
     * @param string $direct
     *
     * @return array
     */
    public function getChunkDocs(
        string $name,
        int    $size = 10,
        string $sort = '_id',
        string $direct = 'desc'
    ): array
    {
        $params = [
            'index' => $name,
            'body' => [
                'query' => [
                    'match_all' => (object)[],
                ],
                'size' => $size,
                'sort' => [
                    $sort => $direct,
                ],
            ],
        ];

        return $this->client->search($params);
    }

    /**
     * Get first index document
     *
     * @param string $name
     *
     * @return array
     */
    public function getFirstDoc(string $name): array
    {
        $params = [
            'index' => $name,
            'body' => [
                'query' => [
                    'match_all' => (object)[],
                ],
                'size' => 1,
            ],
        ];

        return $this->client->search($params);
    }

    /**
     * Get last index document
     *
     * @param string $name
     * @param string $sort
     *
     * @return array
     */
    public function getLastDoc(string $name, string $sort = '_id'): array
    {
        $params = [
            'index' => $name,
            'body' => [
                'query' => [
                    'match_all' => (object)[],
                ],
                'sort' => [
                    $sort => 'desc',
                ],
                'size' => 1,
            ],
        ];

        return $this->client->search($params);
    }
}

