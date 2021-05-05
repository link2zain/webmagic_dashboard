<?php


namespace Webmagic\Dashboard\Elements\Buttons;

use Webmagic\Dashboard\Elements\Buttons\ButtonSwitch\BuildButtonSwitch;
use Webmagic\Dashboard\Elements\Buttons\ButtonSwitch\DefaultButtonSwitch;
use Webmagic\Dashboard\Elements\Buttons\ButtonLink\BuildButtonLink;
use Webmagic\Dashboard\Elements\Buttons\ButtonLink\DefaultButtonLink;
use Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup;
use Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupFactory;

/**********************************************************************************************************************
 * Webmagic\Dashboard\Elements\Buttons\BuildButton
 **********************************************************************************************************************
 *
 * @method   buttonChange()
 * @method   buttonCopy()
 * @method   buttonNewProduct()
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\Dashboard\Elements\Buttons\ButtonSwitch\BuildButtonSwitch
 **********************************************************************************************************************
 *
 * @method   bSwitchCheckedRed()
 * @method   bSwitchCheckedBlue()
 * @method   bSwitchLarge()
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\Dashboard\Elements\Buttons\ButtonLink\BuildButtonLink
 **********************************************************************************************************************
 *
 * @method   bLinkAddPage()
 * @method   bLinkChangeView()
 * @method   bLinkComment()
 * @method   bLinkCreate()
 * @method   bLinkDelete()
 * @method   bLinkDone()
 * @method   bLinkEdit()
 * @method   bLinkEditField()
 * @method   bLinkName()
 * @method   bLinkView()
 * @method   bLinkCog()
 * @method   bLinkFile()
 * @method   bLinkPencil()
 * @method   bLinkCloseSizeNormal()
 * @method   bLinkCloseSizeLarge()
 * @method   bLinkCloseSizeSmall()
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\Dashboard\Elements\Buttons\ButtonGroup\BuildButtonGroup
 **********************************************************************************************************************
 *
 * @method   bGroupLook(array $param)
 * @method   bGroupLookRight(array $param)
 *
 **********************************************************************************************************************/



final class ButtonsFactory
{
    protected $classes = [
        'button' => BuildButton::class,
        'bSwitch' => BuildButtonSwitch::class,
        'bLink' => BuildButtonLink::class,
        'bGroup' => ButtonGroupFactory::class,
    ];

    /**
     * Create default button
     *
     * @param null $param
     * @return DefaultButton
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function prepareDefaultButton($param = null)
    {
        return new DefaultButton($param);
    }

    /**
     * Create default button switch
     *
     * @param null $param
     * @return DefaultButtonSwitch
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function prepareDefaultButtonSwitch($param = null)
    {
        return new DefaultButtonSwitch($param);
    }

    /**
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function prepareDefaultButtonLink($param = null)
    {
        return new DefaultButtonLink($param);
    }

    /**
     * @param null $param
     * @return ButtonGroup
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function prepareDefaultButtonGroup($param = null)
    {
        return new ButtonGroup($param);
    }

    /**
     * @param $method
     * @param $args
     * @return \Exception|mixed|MethodNotAllowedException
     */
    public function __call($method, $args)
    {
        foreach ($this->classes as $alias => $abstract) {
            if (strpos($method, $alias) === 0) {
                $obj = app()->make($this->classes[$alias]);
                return $this->callMethod($obj, $args, $method, $alias);
            }
        }

        return new MethodNotAllowedException($method);
    }

    /**
     * Call method on obj with method name cleaning
     *
     * @param $obj
     * @param $args
     * @param $fullMethodName
     * @param $removeFromMethod
     * @return \Exception|mixed|MethodNotAllowedException
     */
    protected function callMethod($obj, $args, $fullMethodName, $removeFromMethod)
    {
        $method = str_replace($removeFromMethod, '', $fullMethodName);

        try {
            return call_user_func_array([$obj, $method], $args);
        } catch (MethodNotAllowedException $e) {
            return $e;
        }
    }
}
