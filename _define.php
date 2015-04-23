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

$this->registerModule(
	/* Name */			"MyPostCategoryIf",
	/* Description*/		"Multi post categories filter",
	/* Author */		"Adjaya, Pierre Van Glabeke",
	/* Version */		'0.2',
	/* Properties */
	array(
		'permissions' => 'usage,contentadmin',
		'type' => 'plugin',
		'dc_min' => '2.2',
		'support' => 'http://forum.dotclear.org/viewtopic.php?pid=332973#p332973',
		'details' => 'http://plugins.dotaddict.org/dc2/details/myPostCategoryIf'
		)
);