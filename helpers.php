<?php

/**
 * Detect Active Path
 *
 * Compare given path with the current path and return output if they match.
 * Very useful for navigation, marking if the link is active.
 *
 * @param string $path
 * @param string $output
 *
 * @param null   $contains
 *
 * @return string
 */
function activeIfPath(string $path, string $output = 'active', $contains = null): string
{
    if (Request::is($path) && !Request::is($contains)) {
        return $output;
    }

    return '';
}

/**
 * Get the url for a given page by it's system name.
 *
 * @param string $page_name
 * @return string
 */
function routeToPage(string $page_name): string
{
    return route(
        'page.show',
        config('oxygen.page_model')::where('name', $page_name)->firstOrFail()->slug
    );
}

/**
 * Paginate a collection.
 *
 * @param array | Illuminate\Support\Collection $items
 * @param int $perPage
 * @param int $page
 * @param array $options
 *
 * @return Illuminate\Pagination\LengthAwarePaginator
 */
function paginateCollection($items, $perPage = 15, $page = null, $options = [])
{
    $page = $page ?: (Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Illuminate\Support\Collection
        ? $items
        : collect($items);

    return new Illuminate\Pagination\LengthAwarePaginator(
        $items->forPage($page, $perPage),
        $items->count(),
        $perPage,
        $page,
        $options
    );
}
