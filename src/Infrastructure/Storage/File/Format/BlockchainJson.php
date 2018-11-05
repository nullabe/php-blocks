<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Format;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;

/**
 * Class BlockchainJson
 *
 * @package Nbe\PhpBlocks\Infrastructure\Storage\File\Format
 */
class BlockchainJson
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     *
     * @return string
     */
    public function toJson(Blockchain $blockchain): string
    {
        return \json_encode(BlockchainNormalizer::normalize($blockchain));
    }
}