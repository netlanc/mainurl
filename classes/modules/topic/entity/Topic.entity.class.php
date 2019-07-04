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

class PluginMainurl_ModuleTopic_EntityTopic extends PluginMain_Inherit_ModuleTopic_EntityTopic
{

    public function getUrl()
    {

        if ($this->getMainUrl()) {
            $sUrl = $this->getMainUrl();
        } else {
            $sUrl = $this->getId();
        }

        if ($this->getBlog()->getType() == 'personal') {
            return Router::GetPath('blog') . $sUrl . '.html';
        } else {
            return Router::GetPath('blog') . $this->getBlog()->getUrl() . '/' . $sUrl . '.html';
        }

    }

    public function getMainUrl()
    {
        return $this->_aData['topic_main_url'];
    }

    public function setMainUrl($data)
    {
        $this->_aData['topic_main_url'] = $data;
    }

}

?>
