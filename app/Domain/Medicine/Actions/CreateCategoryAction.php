<?php

declare(strict_types=1);

namespace App\Domain\Medicine\Actions;

use App\Domain\Medicine\Contracts\CategoryRepositoryInterface;
use App\Domain\Medicine\DataTransferObjects\CategoryData;
use App\Domain\Medicine\Events\CategoryCreated;
use App\Domain\Medicine\Models\Category;

final readonly class CreateCategoryAction
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(CategoryData $data): Category
    {
        $category = $this->repository->create($data);

        event(new CategoryCreated($category));

        return $category;
    }
}
