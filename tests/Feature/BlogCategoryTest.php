<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Config;
class BlogCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *phpunit BlogPostTest
     * @return void
     */
    public function test_blog_category_index()
    {

        $response = $this->get('/ru/blog/categories');

        $response->assertStatus(200);

    }

}
