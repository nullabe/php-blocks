<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHandlerInterface;

final class BlockHandler implements BlockHandlerInterface
{
    private $blockchain;

    public function __construct(BlockchainInterface $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function addNewBlockToChain(int $proof, string $previousHash = NULL): BlockInterface
    {
        $previousHash = $previousHash ?? BlockHashHandler::hashBlock($this->blockchain->getLastBlock());

        $block = new Block(count($this->blockchain->getChain()) + 1, $this->blockchain->getTransactionStack(), $proof, $previousHash);

        $this->blockchain->appendBlockToChain($block);
        $this->blockchain->resetTransactionStack();

        return $block;
    }

}
