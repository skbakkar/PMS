<?php

declare(strict_types=1);

namespace App\Domain\Medicine\DataTransferObjects;

final readonly class CategoryData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public bool $is_active = true,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            is_active: (bool) ($data['is_active'] ?? true),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];
    }
}
