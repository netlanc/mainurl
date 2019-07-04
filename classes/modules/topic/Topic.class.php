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

class PluginMainurl_ModuleTopic extends PluginMainurl_Inherit_ModuleTopic
{

    public function GetTopicByUrl($sTopicUrl)
    {
        if ($oTopic = $this->oMapperTopic->GetTopicByUrl($sTopicUrl)) {
            $oTopic = $this->Topic_GetTopicById($oTopic->getId());
        }
        return $oTopic;
    }

    public function UpdTopicByUrl($oTopic)
    {
        return $this->oMapperTopic->UpdTopicByUrl($oTopic);
    }

}

?>
