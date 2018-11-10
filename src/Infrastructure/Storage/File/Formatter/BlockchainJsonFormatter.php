<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Formatter\Contract\BlockchainFormatter;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;

/**
 * Class BlockchainJsonFormatter
 *
 * @package Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter
 */
class BlockchainJsonFormatter implements BlockchainFormatter
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     *
     * @return string
     */
    public function format(Blockchain $blockchain): string
    {
        return \json_encode(BlockchainNormalizer::normalize($blockchain));
    }
}