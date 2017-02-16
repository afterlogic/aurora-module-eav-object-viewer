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

require_once "../../common.php";
include_once AURORA_APP_ROOT_PATH.'system/api.php';
\CApi::Init(true);

$response = array(
	'error' => true,
	'message' => 'Unknown error occours',
	'result' => array()
);

$oManagerApi = \CApi::GetSystemManager('eav', 'db');

if (isset($_POST['action']))
{
	switch ($_POST['action'])
	{
		case 'types':
			$response = [
				'error' => false,
				'message'=> '',
				'result' => $oManagerApi->getTypes()
			];			
			break;
		
		case 'create':
			if ($_POST['ObjectName'])
			{
				$sObjectType = $_POST['ObjectName'];
				$oObject = call_user_func($sObjectType . '::createInstance');

				$aMap = $oObject->GetMap();
				$aViewProperties = array_keys($aMap);

				if ($_POST['EntityId'])
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

				if ($_POST['EntityId'])
				{
					$oObject->EntityId = (int)$_POST['EntityId'];

					foreach ($aViewProperties as $property)
					{
						if ($_POST[$property])
						{
							$oObject->{$property} = $_POST[$property];
						}
					}
				}
				
				if (isset($_POST['@DisabledModules'])) {
					$oManagerApi->setAttributes(
						array($oObject->EntityId), 
						array(new \CAttribute('@DisabledModules', $_POST['@DisabledModules'], 'string'))
					);
				}

				$result = $oManagerApi->saveEntity($oObject);

				if ($result) 
				{
					$response['error'] = false;
					$response['message'] = '';
				}
			}
			break;

		case 'delete':
			$oManagerApi->deleteEntity($_POST['EntityId']);
			break;
		
		case 'delete_multiple':
			if ($_POST['ids'])
			{
				$aIds = explode(',', $_POST['ids']);
			}
			foreach ($aIds as $id) 
			{
				if (!$oManagerApi->deleteEntity((int)$id))
				{
					$result = false;
				}
			}

			if ($result) 
			{
				$response['error'] = false;
				$response['message'] = '';
			}
			break;
			
		case 'list':
			if (isset($_POST['ObjectName']))
			{
				$aResultItems = array();

				$aItems = $oManagerApi->getEntities($_POST['ObjectName']);
				if (is_array($aItems))
				{
					foreach ($aItems as $oItem)
					{
						$itemData = $oItem->toArray();
						if ($_POST['ObjectName'] == 'CAccount') 
						{
							$itemData['Password'] = htmlspecialchars($itemData['Password']);
						}
						$aResultItems[] = $itemData;
					}

					$response = [
						'error' => false,
						'message'=> '',
						'result' => $aResultItems
					];
				}
			}
			break;
	}
}


echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
