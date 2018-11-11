<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Repository;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Repository\Contract\BlockchainRepository;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;
use Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter\BlockchainJsonFormatter;

/**
 * Class BlockchainFileRepository
 * @package Nbe\PhpBlocks\Infrastructure\Storage\File\Repository
 */
class BlockchainFileRepository implements BlockchainRepository
{
    const CURRENT_DIR = 'current/';

    const SAVES_DIR = 'saves/';

    /**
     * @var string $storageDir
     */
    private $storageDir;

    /**
     * @var int $storageDirMode
     */
    private $storageDirMode;

    /**
     * BlockchainFileRepository constructor.
     * @param string $projectDir
     * @param string $storageDir
     * @param int $storageDirMode
     */
    public function __construct(string $projectDir, string $storageDir, int $storageDirMode)
    {
        $this->storageDir = $projectDir . $storageDir;
        $this->storageDirMode = $storageDirMode;

        $this->checkStorageDir();
    }

    /**
     * @param Blockchain $blockchain
     * @return bool
     * @throws \Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException
     */
    public function persist(Blockchain $blockchain): bool
    {
        return $this->persistStateFile(BlockchainJsonFormatter::format($blockchain), $blockchain->uuid());
    }

    /**
     * @return Blockchain
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public function get(): Blockchain
    {
        $currentStateFile = $this->getStateFileContent();

        if($currentStateFile) {
            $state = new BlockchainState($currentStateFile);
        }

        return Blockchain::getInstance($state ?? null);
    }

    /**
     * @return void
     */
    private function checkStorageDir(): void
    {
        if (!is_dir($this->storageDir)) {
            mkdir($this->storageDir, $this->storageDirMode);
        }
        if (!is_dir($savesDir = $this->storageDir . self::SAVES_DIR)) {
            mkdir($savesDir, $this->storageDirMode);
        }
        if (!is_dir($currentDir = $this->storageDir . self::CURRENT_DIR)) {
            mkdir($currentDir, $this->storageDirMode);
        }
    }

    /**
     * @return array
     */
    private function getStateFileContent(): array
    {
        $dir = $this->storageDir . self::CURRENT_DIR;

        if (is_readable($dir)) {
            $file = $this->getCurrentStateFile($dir);
            $state = \json_decode(file_get_contents($file), TRUE);
        }

        return is_array($state ?? $state = null) ? $state : [];
    }

    /**
     * @param string $state
     * @param string $uuid
     * @return bool
     */
    private function persistStateFile(string $state, string $uuid): bool
    {
        $currentDir = $this->storageDir . self::CURRENT_DIR;
        $savesDir = $this->storageDir . self::SAVES_DIR;

        if (is_readable($currentDir)) {
            if (!empty(array_diff(scandir($currentDir), array('..', '.')))) {
                unlink($this->getCurrentStateFile($currentDir));
            }

            if($touch = touch($current = $currentDir . $uuid . '.json')) {
                file_put_contents($current, $state);
            }
        }

        if (is_readable($savesDir)) {
            if($touch = touch($save = $savesDir . $uuid . '.json')) {
                file_put_contents($save, $state);
            }
        }

        return $touch ?? false;
    }

    /**
     * @param string $currentDir
     * @return string
     */
    private function getCurrentStateFile(string $currentDir): string
    {
        $scandir = array_diff(scandir($currentDir), array('..', '.'));

        return $currentDir . array_pop($scandir);
    }

}