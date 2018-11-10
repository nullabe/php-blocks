<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;

/**
 * Class TransactionNormalizer
 *
 * @package Nbe\PhpBlocks\Domain\Model\Normalizer
 */
final class TransactionNormalizer
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Transaction $transaction
     *
     * @return array
     */
    public static function normalize(Transaction $transaction): array
    {
        return [
            'sender' => $transaction->getSender()->getHash(),
            'receiver' => $transaction->getReceiver()->getHash(),
            'amount' => $transaction->getAmount(),
            'timestamp' => $transaction->getTimestamp(),
            'hash' => $transaction->getHash(),
        ];
    }

    /**
     * @param array $transaction
     * @return Transaction
     * @throws TransactionDenormalizeException
     */
    public static function denormalize(array $transaction): Transaction
    {
        $transactionData = self::verifyStructure($transaction);

        $transactionFactory = new TransactionFactory();

        $transaction = $transactionFactory($transactionData['sender'], $transactionData['receiver'],
            $transactionData['amount'], $transactionData['timestamp']);

        return $transaction->setHash($transactionData['hash']);
    }

    /**
     * @param array $transaction
     * @return array
     * @throws TransactionDenormalizeException
     */
    private static function verifyStructure(array $transaction): array
    {
        if (!key_exists('sender', $transaction)
            || !key_exists('receiver', $transaction)
            || !key_exists('amount', $transaction)
            || !key_exists('timestamp', $transaction)
            || !key_exists('hash', $transaction)
        ) {
            throw new TransactionDenormalizeException('Array is not valid');
        }

        return $transaction;
    }
}
