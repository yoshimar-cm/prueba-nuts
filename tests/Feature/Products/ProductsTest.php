<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     * A basic feature test example.
     */
    public function can_fetch_a_sigle_product(): void
    {
        $this->withoutExceptionHandling();

        // crear usuario y autneticación
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);

        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
    }
}
