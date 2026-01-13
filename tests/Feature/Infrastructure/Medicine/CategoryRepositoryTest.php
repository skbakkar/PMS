<?php

use App\Domain\Medicine\DataTransferObjects\CategoryData;
use App\Domain\Medicine\Models\Category;
use App\Infrastructure\Medicine\Repositories\CategoryRepository;

beforeEach(function () {
    $this->repository = new CategoryRepository(new Category);
});

test('it can create a category', function () {
    $data = new CategoryData(
        name: 'Painkillers',
        description: 'Pain relief medications',
        is_active: true
    );

    $category = $this->repository->create($data);

    expect($category)->toBeInstanceOf(Category::class)
        ->and($category->name)->toBe('Painkillers')
        ->and($category->is_active)->toBeTrue();

    $this->assertDatabaseHas('categories', [
        'name' => 'Painkillers',
    ]);
});

test('it can find category by id', function () {
    $created = Category::factory()->create(['name' => 'Vitamins']);

    $found = $this->repository->findById($created->id);

    expect($found)->not->toBeNull()
        ->and($found->name)->toBe('Vitamins');
});

test('it returns null for non-existent category', function () {
    $found = $this->repository->findById(999);

    expect($found)->toBeNull();
});

test('it can get all categories', function () {
    Category::factory()->count(5)->create();

    $categories = $this->repository->getAll();

    expect($categories)->toHaveCount(5);
});

test('it can get only active categories', function () {
    Category::factory()->count(3)->create(['is_active' => true]);
    Category::factory()->count(2)->create(['is_active' => false]);

    $active = $this->repository->getActive();

    expect($active)->toHaveCount(3);
});

test('it can update a category', function () {
    $category = Category::factory()->create(['name' => 'Old Name']);

    $data = new CategoryData(
        name: 'New Name',
        description: 'Updated description',
        is_active: true
    );

    $updated = $this->repository->update($category->id, $data);

    expect($updated->name)->toBe('New Name')
        ->and($updated->description)->toBe('Updated description');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'New Name',
    ]);
});

test('it can delete a category', function () {
    $category = Category::factory()->create();

    $result = $this->repository->delete($category->id);

    expect($result)->toBeTrue();
    $this->assertSoftDeleted('categories', ['id' => $category->id]);
});
