<?php

use App\Domain\Medicine\Models\Category;
use App\Presentation\Livewire\Medicine\CategoryManager;
use Livewire\Livewire;

test('component can render', function () {
    Livewire::test(CategoryManager::class)
        ->assertStatus(200);
});

test('can create a category', function () {
    Livewire::test(CategoryManager::class)
        ->set('name', 'Test Category')
        ->set('description', 'Test Description')
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('category-created');

    $this->assertDatabaseHas('categories', [
        'name' => 'Test Category',
        'description' => 'Test Description',
    ]);
});

test('name is required', function () {
    Livewire::test(CategoryManager::class)
        ->set('name', '')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);
});

test('name must be at least 3 characters', function () {
    Livewire::test(CategoryManager::class)
        ->set('name', 'AB')
        ->call('save')
        ->assertHasErrors(['name' => 'min']);
});

test('displays existing categories', function () {
    $categories = Category::factory()->count(3)->create();

    Livewire::test(CategoryManager::class)
        ->assertSee($categories[0]->name)
        ->assertSee($categories[1]->name)
        ->assertSee($categories[2]->name);
});

test('form is reset after successful save', function () {
    Livewire::test(CategoryManager::class)
        ->set('name', 'Test Category')
        ->set('description', 'Test Description')
        ->call('save')
        ->assertSet('name', '')
        ->assertSet('description', '');
});
