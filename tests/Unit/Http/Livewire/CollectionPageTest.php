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
        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->urls->first()->slug])
            ->assertViewIs('livewire.collection-page');
    }

    /**
     * Test 404 when slug doesn't exist.
     *
     * @return void
     */
    public function test_404_if_not_found()
    {
        Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => 'foobar'])
            ->assertStatus(404);
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
            ->assertSeeHtml('<h1>'.$collection->translateAttribute('name').'</h1>')
            ->assertViewIs('livewire.collection-page');
    }
}
