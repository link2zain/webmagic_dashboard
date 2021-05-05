<?php


namespace Webmagic\Dashboard\Elements\Tables\Observers\ManualSorting;


interface ManualSortingObserverInterface
{
    /**
     * Check if manual sorting was activated
     *
     * @return bool
     */
    public function isSorted():bool;

    /**
     * Return identifier for item which was sorted
     *
     * @return string
     */
    public function itemId(): string;

    /**
     * Return identifier for item which was reference for sorting
     * Main item was set before or after reference item
     *
     * @return mixed
     */
    public function referenceItemId(): string;

    /**
     * Check if item was set before reference
     *
     * @return bool
     */
    public function isItemSetBeforeReference(): bool;

    /**
     * Check if item was set after reference
     *
     * @return bool
     */
    public function isItemSetAfterReference(): bool;
}
