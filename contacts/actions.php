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

if ($oHttp->HasPost('action'))
{
//	header('Location: /adm/');
	switch ($oHttp->GetPost('action'))
	{
		case 'create': 
			\CApi::ExecuteMethod('Auth::CreateAccount', array(
				'Token' => $sToken,
				'AuthToken' => $sAuthToken,
				'IdUser' => $oHttp->GetPost('user_id', ''),
				'Login' => $oHttp->GetPost('login', ''),
				'Password' => $oHttp->GetPost('password', '')
			));
			break;
		case 'update':
			\CApi::ExecuteMethod('Auth::UpdateAccount', array(
				'IdAccount' => $oHttp->GetPost('id', ''),
				'Login' => $oHttp->GetPost('login', ''),
				'Password' => $oHttp->GetPost('password', '')
			));
			break;
		case 'delete':
			\CApi::ExecuteMethod('Auth::DeleteAccount', array(
				'Token' => $sToken,
				'AuthToken' => $sAuthToken,
				'IdAccount' => $oHttp->GetPost('id', 0)
			));
			break;
	}
}


