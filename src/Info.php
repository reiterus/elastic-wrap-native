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

use Reiterus\ElasticWrap\Contract\InfoInterface;

/**
 * Get info about cluster or indices
 *
 * @package Reiterus\ElasticWrap
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class Info extends AbstractElastic implements InfoInterface
{
    /**
     * Getting indexes with the most important characteristics.
     * Default: index, health, status, docs.count, store.size
     *
     * @param array $list
     *
     * @return array
     */
    public function getIndices(array $list = []): array
    {
        $params = [
            's' => 'docs.count',
            'h' => 'index,health,status,docs.count,store.size',
        ];

        if (count($list)) {
            $indices = implode('*,*', $list);
            $indices = "*{$indices}*";
            $params['index'] = $indices;
        }

        return $this->client->cat()->indices($params);
    }

    /**
     * Get index aliases with them (true) or without them (false)
     *
     * @param bool $advanced
     *
     * @return array
     */
    public function getAliases(bool $advanced = false): array
    {
        $aliases = $this->client->cat()->aliases();

        $callback = fn(array $item): string => $item['alias'];

        if ($advanced) {
            $callback = fn(array $item): array => [
                $item['alias'] => $item['index']
            ];
        }

        return array_map($callback, $aliases);
    }

    /**
     * Get empty indices list
     *
     * @return array
     */
    public function getEmptyIndices(): array
    {
        $result = [];
        $indices = $this->client->cat()
            ->indices(['h' => 'index,docs.count']);

        foreach ($indices as $index) {
            if ($index['docs.count']) {
                continue;
            }

            $result[] = $index['index'];
        }

        return $result;
    }

    /**
     * Count documents in the index|alias
     *
     * @param string $name
     *
     * @return int|null
     */
    public function getCountDocs(string $name): ?int
    {
        $params ['index'] = $name;
        $response = $this->client->cat()
            ->count($params);

        return $response[0]['count'];
    }
}

