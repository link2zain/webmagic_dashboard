<?php


namespace Webmagic\Dashboard\Crud;


use Illuminate\Database\Eloquent\Model;
use Webmagic\Dashboard\Components\FormPageGenerator;
use Webmagic\Dashboard\Pages\BasePage;

class EntityFormGenerator
{
    /** @var Model */
    protected $entity;

    /** @var FormPageGenerator */
    protected $form;

    /**
     *
     *
     * @param BasePage   $page
     * @param Model|null $item
     *
     * @throws \Exception
     */
    public function generateForm(BasePage $page, Model $item = null)
    {
        if(!is_null($item)){
            $this->setEntity($item);
        }

        $this->form = (new FormPageGenerator($page))
//            ->action()
            ->method(is_null($item) ? 'POST' : 'PUT');


        // Prepare inputs for fields
        $fields = $this->getFields();

        foreach ($fields as $name => $type){
            $method = "{$type}Field";
            if(method_exists($this, $method)){
                $this->$method($name);
            } else {
                $this->stringField($name);
            }
        }
    }

    /**
     * Prepare fields list with types based on DB structure
     *
     * @return array
     */
    protected function getFields(): array
    {
        $table = $this->entity->getTable();
        $columns = array_flip(\Schema::getColumnListing($table));
        $fillable = $this->entity->getFillable();

        $columns = array_only($columns, $fillable);

        foreach ($columns as $name => $val){
            $columns[$name] = \DB::connection()->getDoctrineColumn($table, $name)->getType()->getName();
        }

        return $columns;
    }

    /**
     *  Add string field edit
     *
     * @param      $name
     * @param null $value
     */
    protected function stringField($name, $value = null)
    {
        $this->form->textInput($name, $value, $name);
    }

    /**
     * Set entity
     *
     * @param $entity
     *
     * @return Model
     * @throws \Exception
     */
    public function setEntity($entity)
    {
        if (is_subclass_of($entity, Model::class)) {
            return $this->entity = new $entity;
        }

        if ($entity instanceof Model){
            return $this->entity = $entity;
        }

        throw new \Exception("$entity in not instance of " . Model::class);
    }


    /**
     * Return the entity
     *
     * @return Model
     * @throws \Exception
     */
    public function getEntity()
    {
        if (isset($this->entity) && $this->entity instanceof Model) {
            return $this->entity;
        }

        throw new \Exception('Please, set entity in ' . get_class($this));
    }

}