<?php

namespace DC\ImageView\XF\Entity;
use XF\Mvc\ParameterBag;

class Attachment extends XFCP_Attachment
{
    public function canView(&$error = null)
    {
        $parent = parent::canView();

        $options = \XF::options();
        
        $extensions = $options->dcImageView_attachment_extensions;

        // If option is empty
        if (!$extensions) return $parent;

        $listExtensions = explode("\n", $extensions);
        foreach($listExtensions AS $ex)
        {
            if ($this->getExtension() == $ex) 
            {
                return true;
                break;
            }
        }

        return $parent;
    }
}