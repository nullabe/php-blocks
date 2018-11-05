<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * Class BlockchainNormalizer
 *
 * @package Nbe\PhpBlocks\Domain\Model\Normalizer
 */
final class BlockchainNormalizer
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     *
     * @return array
     */
    public static function normalize(Blockchain $blockchain): array
    {
        foreach ($blockchain->getChain() as $index => $block) {
            $blocks[] = BlockNormalizer::normalize($block);
        }

        return [
            'length' => $blockchain->getNextIndex() - 1,
            'chain'  => $blocks ?? [],
        ];
    }

}
