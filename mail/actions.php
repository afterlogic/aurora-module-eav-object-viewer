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
	$oMailDecorator = \CApi::GetModuleDecorator('Mail');
	
	switch ($oHttp->GetPost('action'))
	{
		case 'create': 
			$mResult = $oMailDecorator->CreateAccount(
				$oHttp->GetPost('user_id', ''),
				$oHttp->GetPost('email', ''),
				$oHttp->GetPost('password', ''),
				$oHttp->GetPost('server', '')
			);
			
			break;
		case 'update':
			$mResult = $oMailDecorator->UpdateAccount(
				$oHttp->GetPost('id', ''),
				$oHttp->GetPost('email', ''),
				$oHttp->GetPost('password', ''),
				$oHttp->GetPost('server', '')
			);
			break;
		case 'delete':
			$mResult = $oMailDecorator->DeleteAccount(
				$oHttp->GetPost('id', '')
			);
			break;
	}
	header('Location: ' . $_SERVER['REQUEST_URI']);
}


