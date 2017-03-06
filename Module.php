<?php
/*
 * @copyright Copyright (c) 2017, Afterlogic Corp.
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

namespace Aurora\Modules\EavObjectViewer;

class Module extends \Aurora\System\Module\AbstractModule
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
			\Aurora\System\Api::checkUserRoleIsAtLeast(\EUserRole::SuperAdmin);
			$bIsAdmin = true;
		}
		catch (\Aurora\System\Exceptions\ApiException $oEcxeption) {}
		
		if ($bIsAdmin)
		{
			$oCoreClientModule = \Aurora\System\Api::GetModule('CoreWebclient');
			if ($oCoreClientModule instanceof \Aurora\System\Module\AbstractModule) 
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