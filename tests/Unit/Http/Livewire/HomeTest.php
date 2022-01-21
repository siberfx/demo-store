<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\Home;
use Livewire\Livewire;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        Livewire::test(Home::class)
            ->assertViewIs('livewire.home');
    }
}
