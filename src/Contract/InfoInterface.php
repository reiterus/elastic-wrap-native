<?php

/*
 * This file is part of the Reiterus package.
 *
 * (c) Pavel Vasin <reiterus@yandex.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reiterus\ElasticWrap\Contract;

/**
 * Interface InfoInterface
 *
 * @package Reiterus\ElasticWrap\Contract
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
interface InfoInterface
{
    /**
     * Getting indexes with the most important characteristics.
     *
     * @param array $list
     *
     * @return array
     */
    public function getIndices(array $list = []): array;

    /**
     * Get index aliases with them (true) or without them (false)
     *
     * @param bool $advanced
     *
     * @return array
     */
    public function getAliases(bool $advanced = false): array;

    /**
     * Count documents in the index|alias
     *
     * @param string $name
     *
     * @return int|null
     */
    public function getCountDocs(string $name): ?int;

    /**
     * Get empty indices list
     *
     * @return array
     */
    public function getEmptyIndices(): array;
}

