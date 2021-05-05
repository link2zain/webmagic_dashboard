<?php


namespace Webmagic\Dashboard\Crud;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Webmagic\Core\ResourceUrls\ResourceUrlsAbleContract;

abstract class AbstractResourceController extends \Webmagic\Core\Controllers\ResourceControllers\AbstractResourceController
{
    /** @var EntityDashboardPresentableContract */
    protected $entityDashboardPresenter;

    /**
     * @throws \Exception
     */
    protected function getEntityDashboardPresenter()
    {
        if(isset($this->entityDashboardPresenter)){
            return new $this->entityDashboardPresenter;
        }

        $entity = $this->getEntity();
        if($entity instanceof ResourceUrlsAbleContract){
            return new ResourceDashboardPresenter($entity, $entity->resourceUrls());
        }

        throw new \Exception(EntityDashboardPresentableContract::class .' should be set or '. get_class($entity) . ' should implement ' . ResourceUrlsAbleContract::class .' in '.get_class($this));
    }

    /**
     * Prepare page with entities list
     *
     * @param Collection|LengthAwarePaginator|array $items
     * @param Request              $request
     *
     * @return string|Renderable
     * @throws \Exception
     */
    protected function prepareListPage($items, Request $request)
    {
        return $this->getEntityDashboardPresenter()->prepareListPage($items, $request, $request->ajax());
    }

    /**
     * Prepare page for create the entity
     *
     *
     * @return mixed
     * @throws \Exception
     */
    protected function prepareCreateFormPage()
    {
        return $this->getEntityDashboardPresenter()->prepareCreateFormPage();
    }

    /**
     * Prepare page for create or edit
     *
     * @param Model|null $item
     *
     * @param Request    $request
     *
     * @return mixed
     * @throws \Exception
     */
    protected function prepareEditFormPage(Model $item, Request $request)
    {
        return $this->getEntityDashboardPresenter()->prepareEditFormPage($item, $request);
    }

    /**
     * Prepare page for show entity
     *
     * @param         $item
     * @param Request $request
     *
     * @return Renderable
     * @throws \Exception
     */
    protected function preparePageForShow(Model $item, Request $request)
    {
        return $this->getEntityDashboardPresenter()->preparePageForShow($item, $request);
    }
}