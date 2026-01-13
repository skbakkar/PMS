<?php

declare(strict_types=1);

namespace App\Infrastructure\Medicine\Repositories;

use App\Domain\Medicine\Contracts\CategoryRepositoryInterface;
use App\Domain\Medicine\DataTransferObjects\CategoryData;
use App\Domain\Medicine\Models\Category;
use Illuminate\Database\Eloquent\Collection;

final readonly class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private Category $model
    ) {}

    public function findById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getActive(): Collection
    {
        return $this->model->active()->get();
    }

    public function create(CategoryData $data): Category
    {
        return $this->model->create($data->toArray());
    }

    public function update(int $id, CategoryData $data): Category
    {
        $category = $this->model->findOrFail($id);
        $category->update($data->toArray());

        return $category->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }
}
