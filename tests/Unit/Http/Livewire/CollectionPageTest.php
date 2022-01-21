<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CollectionPage;
use GetCandy\Models\Collection;
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

    /**
     * Test collection can be loaded via slug.
     *
     * @return void
     */
    public function test_collection_is_rendered()
    {
        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->urls->first()->slug])
            ->assertSee('<h1>'.$collection->translateAttribute('name').'</h1>')
            ->assertViewIs('livewire.collection-page');
    }
}
