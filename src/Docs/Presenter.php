<?php


namespace Webmagic\Dashboard\Docs;

use Webmagic\Dashboard\Elements\Buttons\Button;

class Presenter
{

//       {{-- @php
//        $button = app()->make(\Webmagic\Dashboard\Elements\Buttons\Button::class);
//
//        $presenter = new \Webmagic\Dashboard\Docs\Presenter();
//        $objects = $presenter->showDocs($button);
//    @endphp
//
    //   @foreach($objects as $object)
//       <p>
//       {!! $object !!}
//       </p>
    //   @endforeach
    //--}}

    public function showDocs(Button $object)
    {
        $viewPath = view($object->getView())->getPath();

        $availableFields = $object->getAvailableFields();

        $semplesPath = str_replace('blade.php', 'samples.json', $viewPath);

        $objectClass = get_class($object);

        $paramsColection = [];
        $sampleData = json_decode(file_get_contents($semplesPath), true);

        $maxCount = $this->getMaxCount($sampleData, $availableFields);

        for ($i = 0; $i < $maxCount; $i++) {
            $paramsColection[] = $this->getAllFieldsContent($sampleData, $availableFields, $i);
        }



        $objects = [];

        foreach ($paramsColection as $params) {
            $objects[] = new $objectClass($params);
        }

        return $objects;
    }

    protected function getAllFieldsContent($sampleData, $availableFields, $currentIteration)
    {
        $result = [];
        foreach ($availableFields as $key) {
            $fieldData = $this->getFieldData($sampleData, $key, $currentIteration);
            if ($fieldData) {
                $result[$key] = $fieldData;
            }
        }

        return $result;
    }


    protected function getFieldData($sampleData, $key, $currentIteration)
    {
        if (isset($sampleData[$key])) {
            if (count($sampleData[$key]) <= $currentIteration) {
                $currentIteration = $currentIteration % count($sampleData[$key]);
            }

            return $sampleData[$key][$currentIteration];
        }

        return false;
    }

    protected function getMaxCount(array $data, $availableKeys)
    {
        $count = 0;

        foreach ($availableKeys as $key) {
            if (isset($data[$key]) && count($data[$key]) > $count) {
                $count = count($data[$key]);
            }
        }

        return $count;
    }
}
