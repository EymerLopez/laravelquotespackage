<?php

namespace Eymer\LaravelQuotes\Services;

use Illuminate\Support\Facades\Cache;
use League\CommonMark\Extension\SmartPunct\Quote;

class QuoteCacheService
{
    public function getQuote(int $id): ?array
    {
        $index = $this->searchByBinary($id);
        $quote = null;
        if($index !== -1) {
            $quote = Cache::get('quotes')[$index];
        }

        return $quote;
    }

    public function getQuotes()
    {

        return Cache::get('quotes', []);
    }

    public function addQuote(array $quote): bool
    {
        $quotes = $this->getQuotes();
        $quotes[] = $quote;
        $quotes = collect($quotes)->sortBy('id')->values()->toArray();
        Cache::put('quotes', $quotes, 30);

        return true;
    }

    protected function searchByBinary(int $id): int
    {
        $quotes = $this->getQuotes();
        $start = 0;
        $end = count($quotes) - 1;

        while($start <= $end) {
            $mid = floor(($start + $end) / 2);

            if ( $id == $quotes[$mid]['id']) {
                return $mid;
            }

            if ( $id > $quotes[$mid] ) {
                $start = $mid + 1;
            } else {
                $end = $mid -1;
            }
        }

        return -1;
    }
}
