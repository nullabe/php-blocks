<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;

/**
 * BlockNormalizer class
 */
final class BlockNormalizer
{
    /**
     * @param Block $block
     * @return array
     */
    public static function normalize(Block $block): array
    {
        foreach ($block->getTransactions() as $transaction) {
            if (!$transaction instanceof Transaction) {
                continue;
            }

            $transactions[] = TransactionNormalizer::normalize($transaction);
        }

        return [
            'index'         => $block->getIndex(),
            'timestamp'     => $block->getTimestamp(),
            'transactions'  => $transactions ?? [],
            'proof'         => $block->getProof(),
            'hash'          => $block->getHash(), 
            'previousHash'  => $block->getPreviousHash(),
        ];
    }
}
