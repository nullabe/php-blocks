<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Address;
use PHPUnit\Framework\TestCase;

/**
 * AddressTest class
 */
final class AddressTest extends TestCase
{
    public function testCanInstantiateAddress(): void
    {
        $this->assertInstanceOf(
          Address::class,
          new Address("1")
        );
    }

    public function testCanGetAddressHash(): void
    {
        $address = new Address("1");

        $this->assertEquals(
          "1",
          $address->getHash()
        );
    }

}
