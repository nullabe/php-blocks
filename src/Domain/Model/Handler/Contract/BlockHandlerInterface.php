<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;

/**
 * Interface BlockHandlerInterface
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler\Contract
 */
interface BlockHandlerInterface
{

    /**
     * @param int $proof
     * @param string|null $previousHash
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
     */
    function addNewBlockToChain(int $proof, string $previousHash = NULL): Block;

}
