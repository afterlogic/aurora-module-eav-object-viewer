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

require_once "init.php";

$response = array(
	'error' => true,
	'message' => 'Unknown error occours',
	'result' => array()
);

if ($_POST['ObjectName'])
{
	$aResultItems = array();
	$oManagerApi = \CApi::GetSystemManager('eav', 'db');
	$aTypes = $oManagerApi->getTypes();

	$aItems = $oManagerApi->getEntities($_POST['ObjectName']);
	if (is_array($aItems))
	{
		foreach ($aItems as $oItem)
		{
			$itemData = $oItem->toArray();
			
			$aResultItems[] = $itemData;
		}

		//TODO: fix password encoder
		if ($_POST['ObjectName'] == 'CAccount') {
			foreach ($aResultItems as &$oResultItem) {
				$oResultItem['Password'] = htmlspecialchars($oResultItem['Password']);
			}
		}

		$response['error'] = false;
		$response['message'] = '';
		$response['result'] = $aResultItems;
	}
}
else
{
	$response['message'] = 'Unknown object type';
}

echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
