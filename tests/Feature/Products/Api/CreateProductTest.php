<?php

namespace Tests\Feature\Products\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     * @test
     */
    public function can_create_article(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('api.v1.products.create'), [
            'data' => [
                'type' => 'products',
                'attributes' => [
                    'name' => 'Nuevo producto 02',
                    'description' => 'Descripcion de prueba 02'   ,
                    'slug' => 'nuevo-producto-02',
                    'video' => 'video.mp4',
                    'user_id' => $user->id
                ]
            ]
        ]);

        $response->assertCreated();

        $product = Product::first();

        $response->assertHeader(
            'Location',
            route('api.v1.products.show', $product)
        );

        $response->assertExactJson([
            'data' => [
                'type' => 'products',
                'id' => (string) $product->getRouteKey(),
                'attributes' => [
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'video' => asset("storage/{$product->video}"),
                ],
                'links' => [
                    'self' => route('api.v1.products.show', $product)
                ]
            ]
        ]);
    }
}
