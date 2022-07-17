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
}

