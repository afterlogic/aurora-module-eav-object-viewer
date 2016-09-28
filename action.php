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

if ($_POST['manager'])
{
	require_once "init.php";
	
	$sManagerName = $_POST['manager'];
	
	if (in_array($sManagerName, array('channels', 'tenants', 'accounts', 'users', 'contacts', 'mail', 'objects')))
	{
//		header('Location: /adm/');
		include $sManagerName."/actions.php";
		exit;
	}
	else if ($sManagerName === 'auth')
	{
		if ($oHttp->HasPost('action'))
		{
			switch ($oHttp->GetPost('action'))
			{
				case 'login': 
					$result = \CApi::ExecuteMethod('Auth::Login', array(
						'login' => $oHttp->GetPost('login', ''),
						'password' => $oHttp->GetPost('password', '')
					));
					
					if ($result['AuthToken'])
					{
						$sAuthToken = $result['AuthToken'];
						setcookie('AUTH', $result['AuthToken']);
					}
					break;
				case 'logout': 
					$result = \CApi::ExecuteMethod('Auth::Logout', array(
						'AuthToken' => $sAuthToken
					));
					
					if ($result)
					{
						$sAuthToken = '';
						setcookie ("AUTH", "", time() - 3600);
					}
					break;
			}
		
		}
		
	}
}


