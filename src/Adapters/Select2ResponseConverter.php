<?php

namespace Webmagic\Dashboard\Adapters;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait Select2ResponseConverter
 *
 * Convert data to Select2 format
 * More details about format - https://select2.org/data-sources/formats
 *
 * @package Webmagic\Dashboard\Adapters
 */
trait Select2ResponseConverter
{
    /**
     * Convert regular array to format available for Select 2 plugin
     *
     * @param array       $values
     *
     * @param string|null $valueKey
     * @param string|null $idKey
     *
     * @return array
     */
    protected function convertArrayToSelect2Format(array $values, string $valueKey = null, string $idKey = null): array
    {
        $results= [];
        foreach ($values as $key => $val){
            $results[] = [
                'id' => is_null($idKey) ? $key : $val[$idKey],
                'text' => is_null($valueKey) ? $val : $val[$valueKey]
            ];
        }

        return [
            'results' => $results
        ];
    }

    /**
     * Convert regular array to format available for Select 2 plugin
     *
     * @param string  $idKey
     * @param string  $valueKey
     * @param Model[] $models
     *
     * @return array
     */
    protected function convertModelsToSelect2Format(string $idKey, string $valueKey, Model ... $models): array
    {
        $results= [];
        foreach ($models as $model){
            $results[] = [
                'id' => $model[$idKey],
                'text' => $model[$valueKey]
            ];
        }

        return [
            'results' => $results
        ];
    }
}
