<?php


namespace Webmagic\Dashboard\Elements\Tables\Observers\ManualSorting;


use Illuminate\Http\Request;

class ManualSortingObserver implements ManualSortingObserverInterface
{
    /** @var string */
    protected $itemId;

    /** @var string */
    protected $referenceItemId;

    /** @var string */
    protected $positionType;

    /**
     * ManualSortingObserver constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->loadOptions($request);
    }

    /**
     * Load options from Request
     *
     * @param Request $request
     */
    protected function loadOptions(Request $request)
    {
        $validOptions = $request->validate([
            'entity_id' => 'required|string',
            'reference_entity_id' => 'required|string',
            'reference_type' => 'required|string'
        ]);

        $this->itemId = $validOptions['entity_id'];
        $this->referenceItemId = $validOptions['reference_entity_id'];
        $this->positionType = $validOptions['reference_type'];
    }

    /**
     * @inheritDoc
     */
    public function isSorted(): bool
    {
       return $this->itemId && $this->positionType && $this->referenceItemId;
    }

    /**
     * @inheritDoc
     */
    public function itemId(): string
    {
        return $this->itemId;
    }

    /**
     * @inheritDoc
     */
    public function referenceItemId(): string
    {
        return $this->referenceItemId;
    }

    /**
     * @inheritDoc
     */
    public function isItemSetBeforeReference(): bool
    {
        return $this->positionType == 'before';
    }

    /**
     * @inheritDoc
     */
    public function isItemSetAfterReference(): bool
    {
        return !$this->isItemSetBeforeReference();
    }
}
