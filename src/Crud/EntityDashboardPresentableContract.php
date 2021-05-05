<?php


namespace Webmagic\Dashboard\Crud;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface EntityDashboardPresentableContract
{
    /**
     * Prepare page with entities list
     *
     * @param Collection|LengthAwarePaginator|array $items
     * @param Request                               $request
     *
     * @param bool                                  $isAjaxRequest
     *
     * @return string|Renderable
     */
    public function prepareListPage($items, Request $request, $isAjaxRequest = false);

    /**
     * Prepare page for create the entity
     *
     *
     * @return mixed
     */
    public function prepareCreateFormPage();

    /**
     * Prepare page for create or edit
     *
     * @param Model|null $item
     *
     * @param Request    $request
     *
     * @return mixed
     */
    public function prepareEditFormPage(Model $item, Request $request);

    /**
     * Prepare page for show entity
     *
     * @param         $item
     * @param Request $request
     *
     * @return Renderable
     */
    public function preparePageForShow(Model $item, Request $request);
}