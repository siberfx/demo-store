<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CollectionPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CollectionPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        Livewire::test(CollectionPage::class)
            ->assertViewIs('livewire.collection-page');
    }
}
