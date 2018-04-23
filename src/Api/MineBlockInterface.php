<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;

/**
 * MineBlockInterface interface
 */
interface MineBlockInterface
{
    /**
     * POST Method, mine new Block.
     *
     * @return Block
     */
    public function post(): Block;

}
