<?php

namespace App\Presentation\Livewire\Medicine;

use App\Domain\Medicine\Actions\CreateCategoryAction;
use App\Domain\Medicine\Contracts\CategoryRepositoryInterface;
use App\Domain\Medicine\DataTransferObjects\CategoryData;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryManager extends Component
{
    #[Validate('required|min:3|max:255')]
    public string $name = '';

    #[Validate('nullable|max:1000')]
    public string $description = '';

    #[Validate('boolean')]
    public bool $is_active = true;

    public function save(
        CreateCategoryAction $createAction
    ): void {
        $this->validate();


        $data = new CategoryData(
            name: $this->name,
            description: $this->description,
            is_active: $this->is_active
        );

        $createAction->execute($data);

        $this->reset(['name', 'description']);
        $this->dispatch('category-created');

        session()->flash('message', 'Category created successfully!');
    }

    public function render(
        CategoryRepositoryInterface $repository
    ): View {
        return view('livewire.medicine.category-manager', [
            'categories' => $repository->getAll(),
        ]);
    }
}
