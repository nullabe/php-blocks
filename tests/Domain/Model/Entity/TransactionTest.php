<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Address;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use PHPUnit\Framework\TestCase;

/**
 * TransactionTest class
 */
final class TransactionTest extends TestCase
{
    public function testCanInstantiateTransaction(): void
    {
        $this->assertInstanceOf(
          Transaction::class,
          new Transaction(
                new Address("1"),
                new Address("2"),
                0
          )
        );
    }

    public function testCanGetSenderOfTransaction(): void
    {
        $transaction =
          new Transaction(
            new Address("1"),
            new Address("2"),
            0
          );

        $this->assertInstanceOf(
          Address::class,
          $transaction->getSender()
        );
    }

    public function testCanGetReceiverOfTransaction(): void
    {
        $transaction =
          new Transaction(
            new Address("1"),
            new Address("2"),
            0
          );

        $this->assertInstanceOf(
          Address::class,
          $transaction->getReceiver()
        );
    }

    public function testCanGetAmountOfTransaction(): void
    {
        $transaction =
          new Transaction(
            new Address("1"),
            new Address("2"),
            0.1
          );

        $this->assertEquals(
          0.1,
          $transaction->getAmount()
        );
    }

}
