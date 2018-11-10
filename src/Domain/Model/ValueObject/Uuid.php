<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\ValueObject;

use Nbe\PhpBlocks\Domain\Config\Hash;

/**
 * Trait Uuid
 * @package Nbe\PhpBlocks\Domain\Model\ValueObject
 */
trait Uuid
{
    /**
     * @var string $uuid
     */
    private $uuid;

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid ?? $this->uuid = $this->generateUuid();
    }

    /**
     * @return string
     */
    private function generateUuid(): string
    {
        try {
            $random = random_bytes(Hash::UUID_LGT_BYTES);
        } catch (\Exception $e) {
            $random = uniqid(mt_rand(), true);
        }

        return \hash(Hash::ALGO, microtime() . $random);
    }

}