<?php


namespace Webmagic\Dashboard\Crud;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Webmagic\Core\ResourceUrls\EntityResourceUrlsContract;
use Webmagic\Core\ResourceUrls\ResourceUrlsGeneratorContract;
use Webmagic\Dashboard\Components\FormPageGenerator;
use Webmagic\Dashboard\Components\TablePageGenerator;

class ResourceDashboardPresenter implements EntityDashboardPresentableContract
{
    /** @var Model */
    protected $resourceModel;
    /** @var ResourceUrlsGeneratorContract */
    protected $resourceUrls;

    /**
     * ResourceDashboardPresenter constructor.
     *
     * @param Model                      $resourceModel
     * @param ResourceUrlsGeneratorContract $resourceUrls
     */
    public function __construct(Model $resourceModel, ResourceUrlsGeneratorContract $resourceUrls)
    {
        $this->resourceModel = $resourceModel;
        $this->resourceUrls = $resourceUrls;
    }


    /**
     * Prepare page with entities list
     *
     * @param Collection|LengthAwarePaginator|array $items
     * @param Request                               $request
     *
     * @param bool                                  $isAjaxRequest
     *
     * @return string|Renderable
     * @throws \Webmagic\Dashboard\Core\Content\FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function prepareListPage($items, Request $request, $isAjaxRequest = false)
    {
        return (new TablePageGenerator())
            ->title(class_basename($this->resourceModel).' list')
            ->tableTitles(array_keys($this->prepareTableFields()))
            ->showOnly(array_keys($this->prepareTableFields()))
            ->items($items)
            ->setEntityResourceUrlsGenerator($this->resourceUrls);
    }

    /**
     * Prepare page for create the entity
     *
     *
     * @return mixed
     * @throws \Exception
     */
    public function prepareCreateFormPage()
    {
        $pageFormGenerator = (new FormPageGenerator())
            ->method($this->resourceUrls->storeUrlMethod())
            ->action($this->resourceUrls->storeUrl());

        $fields = $this->getFormFields();
        foreach ($fields as $name => $type){
            $pageFormGenerator->textInput($name, '', $name);
        }

        return $pageFormGenerator;
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
    public function prepareEditFormPage(Model $item, Request $request)
    {
        $pageFormGenerator = (new FormPageGenerator())
            ->method($this->resourceUrls->updateUrlMethod())
            ->action($this->resourceUrls->updateUrl());

        $fields = $this->getFormFields();
        $hidden = $this->resourceModel->getHidden();
        foreach ($fields as $name => $type){
            if(in_array($name, $hidden)){
                $pageFormGenerator->textInput($name, null, $name);
                continue;
            }
            $pageFormGenerator->textInput($name, $item, $name);
        }

        return $pageFormGenerator;
    }


    /**
     * Prepare fields list with types based on DB structure
     *
     * @return array
     */
    protected function getFormFields(): array
    {
        $table = $this->resourceModel->getTable();
        $columns = array_flip(\Schema::getColumnListing($table));
        $fillable = $this->resourceModel->getFillable();

        $columns = array_only($columns, $fillable);

        foreach ($columns as $name => $val){
            $columns[$name] = \DB::connection()->getDoctrineColumn($table, $name)->getType()->getName();
        }

        return $columns;
    }

    /**
     * Prepare field list for table
     *
     * @return array
     */
    protected function prepareTableFields(): array
    {
        $table = $this->resourceModel->getTable();
        $columns = array_flip(\Schema::getColumnListing($table));
        $hidden = $this->resourceModel->getHidden();

        $columns = array_except($columns, $hidden);

        return $columns;
    }


    /**
     * Prepare page for show entity
     *
     * @param Model   $item
     * @param Request $request
     *
     * @return Renderable
     * @throws \Exception
     */
    public function preparePageForShow(Model $item, Request $request)
    {
        return $this->prepareEditFormPage($item, $request);
    }
}