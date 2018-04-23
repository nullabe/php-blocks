<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

/**
 * TransactionNormalizer class
 */
final class TransactionNormalizer
{
    /**
     * @param Transaction $transaction
     * @return array
     */
    public static function normalize(Transaction $transaction): array
    {
        return [
            'sender'    => $transaction->getSender()->getHash(),
            'receiver'  => $transaction->getReceiver()->getHash(),
            'amount'    => $transaction->getAmount(),
        ];
    }
}
