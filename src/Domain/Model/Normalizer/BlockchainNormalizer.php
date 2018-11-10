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
        foreach ($blockchain->getChain() as $block) {
            $blocks[] = BlockNormalizer::normalize($block);
        }
        foreach ($blockchain->getTransactionStack() as $transaction) {
            $transactions[] = TransactionNormalizer::normalize($transaction);
        }

        return [
            'uuid' => $blockchain->uuid(),
            'chain' => $blocks ?? [],
            'transactionStack' => $transactions ?? [],
            'lastBlock' => BlockNormalizer::normalize($blockchain->getLastBlock()),
            'length' => $blockchain->getNextIndex() - 1,
        ];
    }

}
