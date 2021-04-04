<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function test_list_products_when_no_authenticated()
    {
        $this->json('GET', '/api/v1/products')->assertUnauthorized();
    }

    /** @test */
    public function test_list_products_when_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('GET', '/api/v1/products')
            ->assertStatus(200)
            ->assertExactJson(['data' => []]);

        Product::factory()->count(3)->create();

        $this->actingAs($user, 'api')->json('GET', '/api/v1/products')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'code',
                        'size',
                        'composition',
                        'quantity',
                        'created_at',
                        'updated_at'
                    ]
                ]]
            )
            ->assertJsonCount(3, 'data');
            // ->assertExactJson(['data' => []]);
    }

    /** @test */
    public function test_adding_product_when_no_authenticated()
    {
        $this->json('POST', '/api/v1/products')->assertUnauthorized();
    }

    /** @test */
    public function test_adding_product_when_authenticated()
    {
        $user = User::factory()->create();

        $data_product =  [
            'code' => '19837',
            'name' => 'Kit Masculino',
            'size' => '103',
            'composition' => 'Calça e Camisa',
            'quantity' => '2',
        ];

        $this->actingAs($user, 'api')->json('POST', '/api/v1/products', $data_product)
            ->assertCreated()
            ->assertJson(['data' => $data_product]);
    }

    /** @test */
    public function test_adding_product_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('POST', '/api/v1/products')
             ->assertStatus(422)
             ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "code" => ["The code field is required."]
                ]
            ]);
    }


    /** @test */
    public function test_adding_product_with_existing_name()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user, 'api')->json('POST', '/api/v1/products', [
            'name' => $product->name
        ])
             ->assertStatus(422)
             ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name has already been taken."],
                ]
            ]);
    }

    /** @test */
    public function test_adding_product_with_existing_code()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user, 'api')->json('POST', '/api/v1/products', [
            'code' => $product->code
        ])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "code" => ["The code has already been taken."],
                ]
            ]);
    }

    /** @test */
    public function requesting_an_invalid_product_triggers_model_not_found_exception()
    {
        $this->withoutExceptionHandling();
        try {
            $user = User::factory()->create();
            $this->actingAs($user, 'api')->json('GET', '/api/v1/products/123');
        } catch (ModelNotFoundException $exception) {
            $this->assertEquals('No query results for model [App\Models\Product] 123', $exception->getMessage());
            return;
        }

        $this->fail('ModelNotFoundException should be triggered.');
    }

    /** @test */
    public function invalid_product_uri_triggers_fallback_route()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('GET', '/api/v1/products/invalid-product-id')
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    /** @test */
    public function test_editing_product_when_no_authenticated()
    {
        $product = Product::factory()->create();

        $this->json('PUT', "/api/v1/products/{$product->id}",[
            'name' => 'Edited Product'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_editing_product_when_authenticated()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $product_created = $product->toArray();

        $product_created['name'] = 'Edited Product';

        $this->actingAs($user, 'api')->json('PUT', "/api/v1/products/{$product->id}",[
            'name' => $product_created['name']
        ])->assertStatus(200)
          ->assertJson(['data' => $product_created]);
    }

    /** @test */
    public function test_removing_product_when_no_authenticated()
    {
        $product = Product::factory()->create();

        $this->json('DELETE', "/api/v1/products/{$product->id}")
            ->assertUnauthorized();
    }

    /** @test */
    public function test_removing_product_when_authenticated()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user, 'api')->json('DELETE', "/api/v1/products/{$product->id}")
            ->assertNoContent();
    }


}
