<?php

declare(strict_types=1);

namespace App\Domain\Medicine\Contracts;

use App\Domain\Medicine\DataTransferObjects\CategoryData;
use App\Domain\Medicine\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function findById(int $id): ?Category;

    public function getAll(): Collection;

    public function getActive(): Collection;

    public function create(CategoryData $data): Category;

    public function update(int $id, CategoryData $data): Category;

    public function delete(int $id): bool;
}
