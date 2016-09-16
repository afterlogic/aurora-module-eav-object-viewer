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
	$oAuthDecorator = \CApi::GetModuleDecorator('StandardAuth');

	switch ($oHttp->GetPost('action'))
	{
		case 'create': 
			$mResult = $oAuthDecorator->CreateAccount(
				0, // tenant id
				$oHttp->GetPost('user_id', ''),
				$oHttp->GetPost('login', ''),
				$oHttp->GetPost('password', '')
			);
			
			break;
		case 'update':
			$mResult = $oAuthDecorator->UpdateAccount(
				$oHttp->GetPost('id', ''),
				$oHttp->GetPost('login', ''),
				$oHttp->GetPost('password', '')
			);
			break;
		case 'delete':
			$mResult = $oAuthDecorator->DeleteAccount(
				$oHttp->GetPost('id', '')
			);
			break;
	}
	header('Location: ' . $_SERVER['REQUEST_URI']);
}


