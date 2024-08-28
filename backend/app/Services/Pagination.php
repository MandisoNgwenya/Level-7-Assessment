<?php


namespace App\Services;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Pagination
{
    public  static  function data($paginator)
    {
        $paginate = [];
        $paginate['items'] = [];
        $paginate['links'] = $paginator->links()->elements;
        $paginate['count'] = $paginator->count();
        $paginate['current_page'] = $paginator->currentPage();
        $paginate['items'] = $paginator->items();
        $paginate['more_items'] = $paginator->hasMorePages();
        $paginate['last_items'] = $paginator->lastItem();
        $paginate['last_page'] = $paginator->lastPage();
        $paginate['next_page'] = $paginator->nextPageUrl();
        $paginate['per_page'] = $paginator->perPage();
        $paginate['previous_page'] = $paginator->previousPageUrl();
        $paginate['page_url'] = $paginator->url($paginator->currentPage());
        $paginate['total'] = $paginator->total();

        return $paginate;
    }
    public function paginateFilter($items, $perPage = 2, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage;
        $itemToShow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemToShow, $total, $perPage);
    }
}
