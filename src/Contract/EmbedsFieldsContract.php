<?php

namespace Mhhidayat\PhpDiscordClient\Contract;

use Mhhidayat\PhpDiscordClient\Interface\ContractInterface;

class EmbedsFieldsContract implements ContractInterface
{
    private array $fieldsData = [];
    private int $currentIndex = -1;

    public function name(string $name): self
    {
        $this->fieldsData[] = [
            'name' => $name,
        ];

        $this->currentIndex = array_key_last($this->fieldsData);
        return $this;
    }

    public function build(): array
    {
        return $this->fieldsData;
    }
}