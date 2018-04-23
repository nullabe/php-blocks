<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Normalizer;

use PHPUnit\Framework\TestCase;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;

/**
 * TransactionNormalizerTest class
 */
final class TransactionNormalizerTest extends TestCase
{
    public function testTransactionCanBeNormalize()
    {
        $transactionFactory = new TransactionFactory();

        $transaction = $transactionFactory('sender', 'receiver', 0);

        $this->assertEquals(
            [
                'sender'    => $transaction->getSender()->getHash(),
                'receiver'  => $transaction->getReceiver()->getHash(),
                'amount'    => $transaction->getAmount(),
            ],
            TransactionNormalizer::normalize($transaction)
        );
    }
}