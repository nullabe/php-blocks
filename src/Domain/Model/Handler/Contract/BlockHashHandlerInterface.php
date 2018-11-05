<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;

/**
 * Interface BlockHashHandlerInterface
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler\Contract
 */
interface BlockHashHandlerInterface
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Block $block
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
     */
    static function hashBlock(Block $block): Block;

}
