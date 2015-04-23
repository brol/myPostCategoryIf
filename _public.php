<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of myPostCategoryIf, a plugin for Dotclear 2.
#
# Copyright (c) 2003-2015 Adjaya and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_RC_PATH')) { return; }

# Add tp: MyPostCategoryIf
$GLOBALS['core']->tpl->addBlock('MyPostCategoryIf',array('tplMyPostCategoryIf','MyPostCategoryIf'));
	
class tplMyPostCategoryIf
{
	/*dtd
	<!ELEMENT tpl:MyPostCategoryIf - - -- tests on current entry -->
	<!ATTLIST tpl:MyPostCategoryIf
	url		CDATA	#IMPLIED	-- category has given url
	has_entries	(0|1)	#IMPLIED	-- post is the first post from list (value : 1) or not (value : 0)
	>
	*/
	public static function MyPostCategoryIf($attr,$content)
	{
		$if = array();
		$operator = isset($attr['operator']) ? self::getOperator($attr['operator']) : '&&';
		
		if (isset($attr['url'])) {
			$cats_if = array();
			$compar_cat_op = '==';
			$cats_if_op = '||';
			
			$url = addslashes(trim($attr['url']));
			if (substr($url,0,1) == '!') {
				$url = substr($url,1);
				$compar_cat_op = '!=';
				$cats_if_op = '&&';
			}
			$urls = explode(",", $url);
			
			foreach ($urls as $k => $url)
			{
				$cats_if[] = '($_ctx->posts->cat_url '.$compar_cat_op.' "'.$url.'")';
			}
			$if[] = '('.implode(' '.$cats_if_op.' ',$cats_if).')';
		}
		
		if (isset($attr['has_entries'])) {
			$sign = (boolean) $attr['has_entries'] ? '>' : '==';
			$if[] = '$_ctx->categories->nb_post '.$sign.' 0';
		}
		
		if (!empty($if)) {
			return '<?php if('.implode(' '.$operator.' ',$if).') : ?>'.$content.'<?php endif; ?>';
		} else {
			return $content;
		}
	}
	
	protected function getOperator($op)
	{
		switch (strtolower($op))
		{
			case 'or':
			case '||':
				return '||';
			case 'and':
			case '&&':
			default:
				return '&&';
		}
	}	
}