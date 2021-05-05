<?php


namespace Webmagic\Dashboard\Docs\Http;

use Faker\Generator;
use Webmagic\Dashboard\Components\TablePageGenerator;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Boxes\Box;

class TablePresentationController
{
    /**
     * @return TablePageGenerator
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function manualSortingDocs()
    {
        $content = view()->file(__DIR__ . '/../../../docs/tables/manual-sorting.md');
        $box = (new Box())->makeSimple()->content($content);

        $data = $this->prepareFakeData();
        $tablePageGenerator = (new TablePageGenerator())
            // Add items
            ->items($data)
            // Manual sorting activation
            ->manualSorting(
                url()->current(),
                function ($item) {
                    return $item['id'];
                },
                'GET'
            );

        $tablePageGenerator->getPage()->addContent($box, 'data', true);

        return $tablePageGenerator;
    }

    /**
     * Prepare fake data
     *
     * @return array
     */
    protected function prepareFakeData()
    {
        /** @var Generator $faker */
        $faker = app(Generator::class);
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id'      => $faker->numberBetween(0, 100),
                'name'    => $faker->name,
                'address' => $faker->address,
            ];
        }

        return $data;
    }
}
