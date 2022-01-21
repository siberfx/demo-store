<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CollectionPage;
use App\Http\Livewire\ProductPage;
use GetCandy\Models\Collection;
use GetCandy\Models\Product;
use GetCandy\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        $product = Product::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(ProductVariant::factory(), 'variants')
            ->create();

        Livewire::test(ProductPage::class, ['slug' => $product->urls->first()->slug])
            ->assertViewIs('livewire.product-page');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_correct_product_is_loaded()
    {
        $product = Product::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(ProductVariant::factory(), 'variants')
            ->create();

        Livewire::test(ProductPage::class, ['slug' => $product->urls->first()->slug])
            ->assertViewIs('livewire.product-page')
            ->assertSet('product.id', $product->id);
    }
}
