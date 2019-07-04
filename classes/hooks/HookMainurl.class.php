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

class PluginMainurl_HookMainurl extends Hook
{

    public function RegisterHook()
    {

        $this->AddHook('template_copyright', 'Copyright', __CLASS__);
        $this->AddHook('init_action', 'InitAction', __CLASS__);
        $this->AddHook('topic_add_after', 'AddTopicUrl');
        $this->AddHook('topic_edit_after', 'AddTopicUrl');
        $this->AddHook('check_topic_fields', 'TopicCheckField');
        $this->AddHook('template_form_add_topic_topic_end', 'TopicUrlField');
        $this->AddHook('template_form_add_topic_question_end', 'TopicUrlField');
        $this->AddHook('template_form_add_topic_link_end', 'TopicUrlField');
    }

    public function InitAction()
    {

        $sUrl = @$_SERVER['REDIRECT_URL'];
        $aParamsNew = Router::GetParams();

        if (Router::GetAction() == 'error' and substr_count($sUrl, '.html') == 1 and substr_count($sUrl, '/blog/') == 1) {
            $aParams = explode('/', trim($_SERVER['REDIRECT_URL'], '/'));
            $iStrLen = strlen($aParams[count($aParams) - 1]);
            $sUrl = substr($aParams[count($aParams) - 1], 0, $iStrLen - 5);
            $oTopic = $this->Topic_GetTopicByUrl($sUrl);
            if (count($aParams) == 3)
                Router::Action('blog', $oTopic->getBlog()->getUrl(), array($oTopic->getId() . '.html'));
            else
                Router::Action('blog', $oTopic->getId() . '.html', array());
        }
    }

    public function AddTopicUrl($aVars)
    {
        $oTopic = $aVars['oTopic'];
        $sUrl = getRequest('topic_main_url') ? func_translit(getRequest('topic_main_url')) : func_translit(getRequest('topic_title'));
        $oTopic->setMainUrl($sUrl);
        $this->Topic_UpdTopicByUrl($oTopic);
    }

    public function TopicCheckField($aVars)
    {
        $sUrl = getRequest('topic_main_url') ? func_translit(getRequest('topic_main_url')) : func_translit(getRequest('topic_title'));
        if ($oTopicExists = $this->Topic_GetTopicByUrl($sUrl) and $oTopicExists->getId() != Router::GetParam(0)) {
            $this->Message_AddError('Топик с таким URL уже существует', $this->Lang_Get('error'));
            $aVars['bOk'] = false;
        }
    }

    public function TopicUrlField()
    {

        $sActionEvent = Router::GetActionEvent();
        $iTopicId = (int)Router::GetParam(0);
        if ($sActionEvent == 'edit' && $iTopicId) {
            $oTopic = $this->Topic_GetTopicById($iTopicId);
            if ($oTopic) {
                $_REQUEST['topic_main_url'] = $oTopic->getMainUrl();
            }
        }
        $oViewer = $this->Viewer_GetLocalViewer();
        return $oViewer->fetch(Plugin::GetTemplatePath('mainurl') . 'field.mainurl.tpl');
    }

    public function Copyright()
    {
        if (Router::GetAction()!='blog'){
            return false;
        }
        return 'Спонсор плагина - <a href="http://catalognica.ru" target="_blank">catalognica.ru</a><br />';
    }
}

?>
