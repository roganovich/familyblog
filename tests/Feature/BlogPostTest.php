<?php
namespace Tests\Feature;

use App\Models\Blog\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BlogPostTest extends TestCase
{

    /** @test
    * Route::get('/posts', 'PostController@index')->name('locale.blog.posts.index');
     * Проверка страницы списка записей
    */
    public function test_blog_post_index()
    {
        $response = $this->get(route('locale.blog.posts.index',['locale'=>'ru']))->assertSee('Список постов');
        $response->assertStatus(200);
    }

    /** @test
    * Route::get('/posts/show/{slug}', 'PostController@show')->name('locale.blog.posts.show');
     * Проверка страницы одной записи
    */
    public function test_blog_post_show()
    {
        $response = $this->get(route('locale.blog.posts.show',['slug'=>Post::first()->slug,'locale'=>'ru']))->assertSee(Post::first()->title);
        $response->assertStatus(200);
    }

    /** @test
    * //Moderate Blogs Frontend routes Group
    * Route::post('/posts/update/{id}', 'PostController@update')->name('locale.moderate.blog.posts.update');
     * Проверка обновления записи
    */
    public function test_moderate_blog_post_edit()
    {
        $this->withExceptionHandling();
        $this->be(Post::first()->author, 'admin');
        $post = $this->post(route('locale.moderate.blog.posts.update',['id'=>Post::first()->id,'locale'=>'ru']),
            [
                'title'=>'Test title',
                'slug'=>'test_title',
            ]
        );
        $this->assertEquals('Test title',Post::first()->title);
        $this->assertEquals('test_title',Post::first()->slug);
    }
}
