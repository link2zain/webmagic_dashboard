<?php


namespace Webmagic\Dashboard\Elements\Buttons\ButtonSwitch;

class BuildButtonSwitch
{

    /**
     * Create checked button switch color red
     *
     * @param null $param
     * @return ButtonSwitchChecked
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function checkedRed($param = null)
    {
        $default = [
            'checked' => true,
            'color' => 'red',
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;


        return new ButtonSwitchChecked($arg);
    }

    /**
     * Create checked button switch color blue
     *
     * @param null $param
     * @return ButtonSwitchChecked
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function checkedBlue($param = null)
    {
        $default = [
            'checked' => true,
            'color' => '#3c8dbc',
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new ButtonSwitchChecked($arg);
    }

    /**
     * Create large button
     *
     * @param null $param
     * @return DefaultButtonSwitch
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function large($param = null)
    {
        $default = [
            'size' => 'large',
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;


        return new DefaultButtonSwitch($arg);
    }
}
