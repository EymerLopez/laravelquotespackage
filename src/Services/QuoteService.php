<?php

namespace Eymer\LaravelQuotes\Services;

use Eymer\LaravelQuotes\Exceptions\LaravelQuoteException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class QuoteService
{
    public function __construct(protected QuoteCacheService $quoteCacheService)
    {
    }

    /**
     * @throws LaravelQuoteException|ConnectionException
     */
    public function getAllQuotes(array $params = [])
    {
        $url = $this->getBaseUrl();
        $response = Http::withQueryParameters($params)->get($url);
        $this->validateResponse($response, $url);

        return $response->json();
    }

    public function getRandomQuote()
    {
        $url = $this->getCustomUrl('random');
        $response = Http::get($url);
        $this->validateResponse($response, $url);

        return $response->json();
    }

    public function getQuote(int $id)
    {
        $quote = $this->getQuoteInCache($id);
        if (is_null($quote)) {
            $url = $this->getCustomUrl($id);
            $response = Http::get($url);
            $this->validateResponse($response, $url);
            $quote = $response->json();
            if (isset($quote['id'])) {
                $this->quoteCacheService->addQuote($quote);
            }
        }

        return response()->json($quote);
    }

    public function getQuoteInCache(int $id): ?array
    {
        return $this->quoteCacheService->getQuote($id);
    }

    protected function getBaseUrl(): string
    {
        return config('quotes.url').'quotes';
    }

    protected function getMaxLimitPerRequest(): int
    {
        return config('quotes.max_limit_per_request');
    }

    protected function getDuration(): int
    {
        return config('quotes.duration');
    }

    protected function getCustomUrl(string $url): string
    {
        return $this->getBaseUrl().'/'.$url;
    }

    /**
     * @throws LaravelQuoteException
     */
    protected function validateResponse(Response $response, string $url)
    {
        if (!$response->ok() && !$response->notFound()) {
            throw new LaravelQuoteException("An error occurred while trying to get the resource from the URL: {$url}", $response->getStatusCode());
        }
    }
}
