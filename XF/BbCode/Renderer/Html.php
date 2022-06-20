<?php

/*
 * Created on Wed Mar 27 2019
 * HomePage: http://dcforo.com/
 * Email: datdaik000@gmail.com
 * Blog: https://fb.com/dcstylexf/
 * Copyright (c) 2019 D.C Style XenForo -  All Rights Reserved
 */

namespace DC\ImageView\XF\BbCode\Renderer;

use XF\Entity\User;
use XF\Mvc\Entity\ArrayCollection;
use XF\PreEscaped;
use XF\Str\Formatter;
use XF\Template\Templater;

class Html extends XFCP_Html
{
	public function renderTagAttach(array $children, $option, array $tag, array $options)
    {
		$extensions = \XF::options()->dcImageView_attachment_extensions;

        // If option is empty
		if (!$extensions) return parent::renderTagAttach($children, $option, $tag, $options);

		$id = intval($this->renderSubTreePlain($children));

		if(isset($options['attachments'][$id]) && $options['attachments'][$id]) 
		{
			$listExtensions = explode("\n", $extensions);
			
			$attachment = $options['attachments'][$id];

			foreach($listExtensions AS $ex)
			{
				if($attachment['extension'] == $ex) 
				{
					$options['viewAttachments'] = true;
					break;
				}
			}
		}

		return parent::renderTagAttach($children, $option, $tag, $options);
    }
}