<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHandlerInterface;

/**
 * Block class
 */
final class BlockHandler implements BlockHandlerInterface
{
    /**
     * @var Blockchain
     */
    private $blockchain;

    /**
     * @param Blockchain $blockchain
     */
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    /**
     * @param integer $proof
     * @param string $previousHash
     * @return Block
     */
    public function addNewBlockToChain(int $proof, string $previousHash = NULL): Block
    {
        $previousHash = $previousHash ?? $this->blockchain->getLastBlock()->getHash();

        $block = new Block($this->blockchain->getNextIndex(), $this->blockchain->getTransactionStack(), $previousHash);
        $block = BlockHashHandler::hashBlock($block);

        $this->blockchain->appendBlockToChain($block);
        $this->blockchain->resetTransactionStack();

        return $block;
    }

}
