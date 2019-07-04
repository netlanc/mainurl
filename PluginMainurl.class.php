<?php

/* -------------------------------------------------------
 *
 *   LiveStreet (v.1.x)
 *   Plugin Mainurl (v.0.2)
 *   Copyright © 2011 Bishovec Nikolay
 *
 * --------------------------------------------------------
 *
 *   Plugin Page: http://netlanc.net
 *   Contact e-mail: netlanc@yandex.ru
 *
  ---------------------------------------------------------
 */

if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginMainurl extends Plugin
{

    protected $aInherits = array(
        'module' => array('ModuleTopic'),
        'mapper' => array('ModuleTopic_MapperTopic' => '_ModuleTopic_MapperTopic'),
        'entity' => array('ModuleTopic_EntityTopic'),
    );

    public function Activate()
    {
        if (!$this->isFieldExists('prefix_topic', 'topic_main_url')) {
            $this->ExportSQL(dirname(__FILE__) . '/dump.sql');
        }
        return true;
    }

    public function Init()
    {

    }

}

?>
