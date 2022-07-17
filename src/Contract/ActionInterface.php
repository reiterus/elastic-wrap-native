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
 * Interface ActionInterface
 *
 * @package Reiterus\ElasticWrap\Contract
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
interface ActionInterface
{
    /**
     * Remove Empty Indexes
     *
     * @param array $indices
     *
     * @return int|null
     */
    public function deleteEmptyIndices(array $indices): ?int;

    /**
     * Get all index documents.
     * Use this for small indexes!
     *
     * @param string $name
     *
     * @return array
     */
    public function getAllDocs(string $name): array;

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
    public function getChunkDocs(string $name, int $size = 10, string $sort = '_id', string $direct = 'desc'): array;

    /**
     * Get first index document
     *
     * @param string $name
     *
     * @return array
     */
    public function getFirstDoc(string $name): array;

    /**
     * Get last index document
     *
     * @param string $name
     * @param string $sort
     *
     * @return array
     */
    public function getLastDoc(string $name, string $sort = '_id'): array;
}

