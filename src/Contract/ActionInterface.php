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
}

