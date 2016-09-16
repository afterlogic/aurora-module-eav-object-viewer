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

$oHttp = \MailSo\Base\Http::NewInstance();

$oManagerApi = \CApi::GetSystemManager('eav', 'db');

switch ($oHttp->GetPost('action'))
{
	case 'create':
		if ($oHttp->HasPost('ObjectName'))
		{
			$sObjectType = $oHttp->GetPost('ObjectName');
			$oObject = call_user_func($sObjectType . '::createInstance');

			$aMap = $oObject->GetMap();
			$aViewProperties = array_keys($aMap);

			if ($oHttp->HasPost('iObjectId'))
			{
				foreach ($aViewProperties as $property)
				{
					if ($oHttp->HasPost($property))
					{
						$oObject->{$property} = $oHttp->GetPost($property);
					}
				}
			}

			$oManagerApi->saveEntity($oObject);
		}
		break;
	
	case 'edit':
		if ($oHttp->HasPost('ObjectName'))
		{
			$sObjectType = $oHttp->GetPost('ObjectName');
			$oObject = call_user_func($sObjectType . '::createInstance');

			$aMap = $oObject->GetMap();
			$aViewProperties = array_keys($aMap);

			if ($oHttp->HasPost('iObjectId'))
			{
				$oObject->iId = (int)$oHttp->GetPost('iObjectId');

				foreach ($aViewProperties as $property)
				{
					if ($oHttp->HasPost($property))
					{
						$oObject->{$property} = $oHttp->GetPost($property);
					}
				}
			}
			
			$oManagerApi->saveEntity($oObject);
		}
		break;
	
	case 'delete':
		$oManagerApi->deleteEntity($oHttp->GetPost('iObjectId'));
		break;
	case 'delete_multiple':
		if ($oHttp->HasPost('ids'))
		{
			$aIds = explode(',', $oHttp->GetPost('ids'));
		}
		foreach ($aIds as $id) {
			$oManagerApi->deleteEntity((int)$id);
		}
		break;
}

header('Location: ' . $_SERVER['REQUEST_URI']);
