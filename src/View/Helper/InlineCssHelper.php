<?php
namespace InlineCss\View\Helper;

use Cake\View\Helper;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class InlineCssHelper extends Helper
{

    /**
     * After layout logic.
     *
     * @param  \Cake\Event\Event  $event  Event
     * @param  string  $layoutFile  Layout filename
     *
     * @throws \TijsVerkoyen\CssToInlineStyles\Exception
     */
    public function afterLayout(\Cake\Event\Event $event, $layoutFile)
    {
        $content = $this->_View->fetch('content');

        if (!isset($this->InlineCss)) {
            $this->InlineCss = new CssToInlineStyles();
        }

        // Convert inline style blocks to inline CSS on the HTML content.
        $this->InlineCss->setHTML($content);
        $this->InlineCss->setUseInlineStylesBlock(true);
        $content = $this->InlineCss->convert();

        $this->_View->assign('content', $content);

        return;
    }

}
