<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    /** @test */
    public function an_author_can_be_created(): void
    {
        $this->withoutExceptionHandling();
        $date = '1997/01/01';

        $data = [
            'name' => 'John doe',
            'dob' => $date,
        ];

        $this->post('api/authors', $data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson(
                Arr::set($data, 'dob', Carbon::parse($date)->toISOString()),
            );

        $authors = Author::all();
        $author = $authors->first();

        $this->assertCount(1, $authors);
        $this->assertInstanceOf(Carbon::class, $author->dob);
        $this->assertEquals($date, $author->dob->format('Y/m/d'));
    }
}
