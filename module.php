<?php
/*
 * @copyright Copyright (c) 2016, Afterlogic Corp.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

namespace Aurora\Modules;

class EavObjectViewerModule extends \AApiModule
{
	public function init() 
	{
		$this->AddEntry('eav-viewer', 'EntryEavObjectViewer');
	}
	
	public function EntryEavObjectViewer()
	{
		$bIsAdmin = false;
		try
		{
			\CApi::checkUserRoleIsAtLeast(\EUserRole::SuperAdmin);
			$bIsAdmin = true;
		}
		catch (\System\Exceptions\AuroraApiException $oEcxeption) {}
		
		if ($bIsAdmin)
		{
			$oCoreClientModule = \CApi::GetModule('CoreWebclient');
			if ($oCoreClientModule instanceof \AApiModule) 
			{
				return file_get_contents($this->GetPath().'/templates/Index.html');
			}
		}
		else
		{
			echo "Auth Error!";
		}
	}
}