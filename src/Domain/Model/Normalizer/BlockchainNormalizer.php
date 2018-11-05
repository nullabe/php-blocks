<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * BlockchainNormalizer class
 */
final class BlockchainNormalizer
{
    /**
     * @param Blockchain $blockchain
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
