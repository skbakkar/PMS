<?php

use App\Domain\Medicine\Actions\CreateCategoryAction;
use App\Domain\Medicine\Contracts\CategoryRepositoryInterface;
use App\Domain\Medicine\DataTransferObjects\CategoryData;
use App\Domain\Medicine\Events\CategoryCreated;
use App\Domain\Medicine\Models\Category;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    Event::fake();
});

test('it creates a category successfully', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $action = new CreateCategoryAction($repository);

    $data = new CategoryData(
        name: 'Antibiotics',
        description: 'Antibiotic medicines',
        is_active: true
    );

    $category = new Category([
        'id' => 1,
        'name' => 'Antibiotics',
        'description' => 'Antibiotic medicines',
        'is_active' => true
    ]);

    $repository->shouldReceive('create')
        ->once()
        ->with($data)
        ->andReturn($category);

    // Act
    $result = $action->execute($data);

    // Assert
    expect($result)->toBeInstanceOf(Category::class)
        ->and($result->name)->toBe('Antibiotics');

    Event::assertDispatched(CategoryCreated::class, function ($event) use ($category) {
        return $event->category->name === $category->name;
    });
});

test('it validates required fields', function () {
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $action = new CreateCategoryAction($repository);

    // This should throw type error for missing required field
    new CategoryData(
        name: '',  // Empty name should fail
        description: null,
        is_active: true
    );
})->throws(TypeError::class);
