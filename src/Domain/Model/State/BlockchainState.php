<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\State;

use Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException;

class BlockchainState
{
    /**
     * @var array $state ;
     */
    private $state;

    /**
     * @param array $blockchain
     * @return BlockchainState
     * @throws BuildBlockchainStateException
     */
    public function __construct(array $blockchain)
    {
        return $this->setState($blockchain);
    }

    /**
     * @return array
     */
    public function getState(): array
    {
        return $this->state;
    }

    /**
     * @param array $blockchain
     * @return BlockchainState
     * @throws BuildBlockchainStateException
     */
    private function setState(array $blockchain): BlockchainState
    {
        $this->state = $this->verifyStructure($blockchain);

        return $this;
    }

    /**
     * @param array $blockchain
     * @return array
     * @throws BuildBlockchainStateException
     */
    private function verifyStructure(array $blockchain): array
    {
        if (!key_exists('uuid', $blockchain)
        || !key_exists('chain', $blockchain)
        || !key_exists('transactionStack', $blockchain)
        || !key_exists('lastBlock', $blockchain)
        || !key_exists('length', $blockchain)
        ) {
            throw new BuildBlockchainStateException('Array is not valid');
        }

        return $blockchain;
    }
}