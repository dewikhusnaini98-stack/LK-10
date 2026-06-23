<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that the root URL redirects to the login page.
     */
    public function test_root_redirects_to_login(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    /**
     * Test that the login page returns a successful response.
     */
    public function test_login_page_is_successful(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test that requesting the show book page returns 405 (Method Not Allowed) since it is disabled.
     */
    public function test_show_book_returns_405(): void
    {
        $response = $this->get('/books/1');
        $response->assertStatus(405);
    }
}
