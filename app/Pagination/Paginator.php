<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Paginator extends LengthAwarePaginator
{
    public function url($page)
    {
        if ($page <= 0) {
            $page = 1;
        }

        $parameters = $page === 1 ? [] : [$this->pageName => $page];

        if (count($this->query) > 0) {
            $parameters = array_merge($this->query, $parameters);
        }

        $divide = Str::contains($this->path(), '?') ? '&' : '?';

        $queryString = count($parameters)
            ? ($divide.Arr::query($parameters))
            : '';

        return $this->path().$queryString.$this->buildFragment();
    }

    public function linkCollection()
    {
        return collect($this->elements())
            ->flatMap(fn ($item) => is_array($item)
                ? collect($item)->map(fn ($url, $page) => [
                    'url' => $url,
                    'label' => $page,
                    'active' => $this->currentPage() === $page,
                ])
                : [['url' => null, 'label' => '...', 'active' => false]]
            )
            ->prepend([
                'url' => $this->previousPageUrl(),
                'label' => __('pagination.previous'),
                'active' => false,
            ])
            ->push([
                'url' => $this->nextPageUrl(),
                'label' => __('pagination.next'),
                'active' => false,
            ]);
    }

    public function toArray()
    {
        return [
            'data' => $this->items->toArray(),
            'links' => $this->linkCollection()->toArray(),
            'showPaginator' => $this->hasPages(),
        ];
    }
}
