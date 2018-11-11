<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Formatter\Contract\BlockchainFormatter;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;

/**
 * Class BlockchainJsonFormatter
 *
 * @package Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter
 */
class BlockchainJsonFormatter implements BlockchainFormatter
{

    /**
     * @param Blockchain $blockchain
     * @return string
     * @throws \Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException
     */
    public static function format(Blockchain $blockchain): string
    {
        $state = new BlockchainState(BlockchainNormalizer::normalize($blockchain));

        return \json_encode($state->getState());
    }
}