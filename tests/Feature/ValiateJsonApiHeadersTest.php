<?php

namespace Tests\Feature;

use App\Http\Middleware\ValidateJsonApiHeaders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class ValiateJsonApiHeadersTest extends TestCase
{

    /**
     * @test
     */
    public function accept_header_must_be_present_in_all_request(): void
    {
        Route::get('test_route', function(){
            return 'OK';
        })->middleware(ValidateJsonApiHeaders::class);


        $this->get('test_route')->assertStatus(406);


        $this->get('test_route',[
            'accept' => 'application/vnd.api+json'
        ])->assertSuccessful();
    }


    /**
     * @test
     */
    public function content_type_header_must_be_present_on_all_posts_request(): void
    {
        Route::post('test_route', function(){
            return 'OK';
        })->middleware(ValidateJsonApiHeaders::class);

        $this->post('test_route',[],[
            'accept' => 'application/vnd.api+json',
        ])->assertStatus(415);

        $this->post('test_route',[],[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertSuccessful();

    }


    /**
     * @test
     */
    public function content_type_header_must_be_present_on_all_patch_request(): void
    {
        Route::patch('test_route', function(){
            return 'OK';
        })->middleware(ValidateJsonApiHeaders::class);

        $this->patch('test_route',[],[
            'accept' => 'application/vnd.api+json',
        ])->assertStatus(415);

        $this->patch('test_route',[],[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertSuccessful();

    }
}
