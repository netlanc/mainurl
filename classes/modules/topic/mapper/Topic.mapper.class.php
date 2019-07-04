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

class PluginMainurl_ModuleTopic_MapperTopic extends PluginMainurl_Inherit_ModuleTopic_MapperTopic
{
    public function GetTopicByUrl($sTopicUrl)
    {
        $sql = "SELECT topic_id FROM " . Config::Get('db.table.topic') . "
                WHERE
                    topic_main_url =?
                    ";
        if ($aRow = $this->oDb->selectRow($sql, $sTopicUrl)) {
            return Engine::GetEntity('Topic', $aRow);
        }
        return null;
    }

    public function UpdTopicByUrl($oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
                SET
                    topic_main_url=?
                WHERE
                    topic_id = ?
            ";
        if ($this->oDb->query($sql, $oTopic->getMainUrl(), $oTopic->getId())) {
            return true;
        }
        return false;
    }
}

?>
