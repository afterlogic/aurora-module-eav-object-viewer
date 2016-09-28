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

// $oHttp = \MailSo\Base\Http::NewInstance();

$oManagerApi = \CApi::GetSystemManager('eav', 'db');


$response = array(
	'error' => true,
	'message' => 'Unknown error occours',
	'result' => array()
);

switch ($_POST['action'])
{
	case 'create':
		if ($_POST['ObjectName'])
		{
			$sObjectType = $_POST['ObjectName'];
			$oObject = call_user_func($sObjectType . '::createInstance');

			$aMap = $oObject->GetMap();
			$aViewProperties = array_keys($aMap);

			if ($_POST['iObjectId'])
			{
				foreach ($aViewProperties as $property)
				{
					if ($_POST[$property])
					{
						$oObject->{$property} = $_POST[$property];
					}
				}
			}

			$oManagerApi->saveEntity($oObject);
		}
		break;
	
	case 'edit':
		if ($_POST['ObjectName'])
		{
			$sObjectType = $_POST['ObjectName'];
			$oObject = call_user_func($sObjectType . '::createInstance');

			$aMap = $oObject->GetMap();
			$aViewProperties = array_keys($aMap);

			if ($_POST['iObjectId'])
			{
				$oObject->iId = (int)$_POST['iObjectId'];

				foreach ($aViewProperties as $property)
				{
					if ($_POST[$property])
					{
						$oObject->{$property} = $_POST[$property];
					}
				}
			}

			$result = $oManagerApi->saveEntity($oObject);

			if ($result) {
				$response['error'] = false;
				$response['message'] = '';
			}
		}
		break;
	
	case 'delete':
		$oManagerApi->deleteEntity($_POST['iObjectId']);
		break;
	case 'delete_multiple':
		if ($_POST['ids'])
		{
			$aIds = explode(',', $_POST['ids']);
		}
		foreach ($aIds as $id) {
			if (!$oManagerApi->deleteEntity((int)$id))
			{
				$result = false;
			}
		}
		
		if ($result) {
			$response['error'] = false;
			$response['message'] = '';
		}
		break;
}

echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

// header('Location: ' . $_SERVER['REQUEST_URI']);
