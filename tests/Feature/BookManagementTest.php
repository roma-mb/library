<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    /** @test */
    public function a_book_can_be_added_to_the_library(): void
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Book Title',
            'author' => 'John doe',
            'description' => 'Book Description',
        ];

        $this->post('api/books', $data)->assertRedirect('books.index');
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required(): void
    {
        $data = [
            'title' => 'Book Title',
            'description' => 'Book Description',
        ];

        $this->post('api/books', $data)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_update(): void
    {
        $book = Book::factory()->create([
            'id' => 1,
            'title' => 'Book Title',
            'author' => 'John doe',
            'description' => 'Book Description',
        ]);

        $dataToUpdate = [
            'title' => 'New Title',
            'author' => 'New Author',
        ];

        $this->put('api/books/' . $book->id, $dataToUpdate)
            ->assertRedirect('/api/books/' . $book->id);

        $this->assertEquals($dataToUpdate['title'], $book->fresh()->title);
    }

    /** @test */
    public function a_book_can_be_deleted(): void
    {
        $book = Book::factory()->create([
            'id' => 1,
            'title' => 'Book Title',
            'author' => 'John doe',
            'description' => 'Book Description',
        ]);

        $this->delete('api/books/' . $book->id)
            ->assertRedirect('books.index');

        $this->assertEmpty(Book::all());
    }
}
