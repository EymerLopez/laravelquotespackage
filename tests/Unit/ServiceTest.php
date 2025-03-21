<?php

use Eymer\LaravelQuotes\Services\QuoteService;
use Mockery\MockInterface;

test('get list of quotes', function () {

    $this->instance(
        QuoteService::class,
        Mockery::mock(QuoteService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAllQuotes')
                ->once()
                ->andReturn([
                    "quotes" => [
                        "id" => 1,
                        "quote" => "Test quote.",
                        "author" => "Test author.",
                    ],
                    "total" => 1000,
                    "skip" => 0,
                    "limit" => 1,
                ]);
        })
    );

    $this->get(route('api.quotes.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'quotes',
            'total',
            'skip',
            'limit',
        ]);
});

test('get random quote', function () {

    $this->instance(
        QuoteService::class,
        Mockery::mock(QuoteService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getRandomQuote')
                ->once()
                ->andReturn([
                    "id" => 1,
                    "quote" => "Test quote.",
                    "author" => "Test author.",
                ]);
        })
    );

    $this->get(route('api.quotes.random'))
        ->assertOk()
        ->assertJsonStructure([
            'id',
            'quote',
            'author'
        ]);
});

test('get quote by id', function () {
    $this->instance(
        QuoteService::class,
        Mockery::mock(QuoteService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getQuote')
                ->once()
                ->andReturn([
                    "id" => 5,
                    "quote" => "Test quote.",
                    "author" => "Test author.",
                ]);
        })
    );

    $response = $this->get(route('api.quotes.show', ['id' => 5]));
    // another assert
    $response->assertOk()
        ->assertJsonPath('id', 5);
});

test('get not found quote', function () {
    $this->instance(
        QuoteService::class,
        Mockery::mock(QuoteService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getQuote')
                ->once()
                ->andReturn([
                    "message" => "Test quote with id 9999 not found.",
                ]);
        })
    );

    $this->get(route('api.quotes.show', ['id' => 9999]))
        ->assertOk()
        ->assertJsonStructure([
            'message',
        ]);
});
