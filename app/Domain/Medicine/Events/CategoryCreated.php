<?php

declare(strict_types=1);

namespace App\Domain\Medicine\Events;

use App\Domain\Medicine\Models\Category;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class CategoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly Category $category
    ) {}
}
