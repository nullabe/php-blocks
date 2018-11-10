<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

/**
 * Class BlockNormalizer
 *
 * @package Nbe\PhpBlocks\Domain\Model\Normalizer
 */
final class BlockNormalizer
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Block $block
     *
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
            'index' => $block->getIndex(),
            'timestamp' => $block->getTimestamp(),
            'transactions' => $transactions ?? [],
            'proof' => $block->getProof(),
            'hash' => $block->getHash(),
            'previousHash' => $block->getPreviousHash(),
        ];
    }

    /**
     * @param array $block
     * @return Block
     * @throws BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public static function denormalize(array $block): Block
    {
        $blockData = self::verifyStructure($block);

        foreach ($blockData['transactions'] as $transaction) {
            $transactions[] = TransactionNormalizer::denormalize($transaction);
        }

        $block = new Block(
            $blockData['index'],
            $transactions ?? [],
            $blockData['previousHash'],
            $blockData['timestamp']
        );

        $block->setProof($blockData['proof']);
        $block->setHash($blockData['hash']);

        return $block;
    }

    /**
     * @param array $block
     * @return array
     * @throws BlockDenormalizeException
     */
    private static function verifyStructure(array $block): array
    {
        if (!key_exists('index', $block)
            || !key_exists('timestamp', $block)
            || !key_exists('transactions', $block)
            || !key_exists('proof', $block)
            || !key_exists('hash', $block)
            || !key_exists('previousHash', $block)
        ) {
            throw new BlockDenormalizeException('Array is not valid');
        }

        return $block;
    }
}
