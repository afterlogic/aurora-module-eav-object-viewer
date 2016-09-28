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

class EavObjectViewerModule extends AApiModule
{
	public $oCoreDecorator = null;
	
	public function init() 
	{
		$this->AddEntry('eav-viewer', 'EntryEavObjectViewer');
		
		$this->oCoreDecorator = \CApi::GetModuleDecorator('Core');
	}
	
	public function EntryEavObjectViewer()
	{
		// $oAuthenticatedAccount = $this->oHelpDeskDecorator->GetCurrentUser();

		$oApiIntegrator = \CApi::GetSystemManager('integrator');
		
		// $sTenantName = \CApi::getTenantName();
		// $mHelpdeskIdTenant = $this->oCoreDecorator->GetTenantIdByName($sTenantName);
		
		// if (!is_int($mHelpdeskIdTenant))
		// {
			// \CApi::Location('./');
			// return '';
		// }

		// $bDoId = false;
		// $sThread = $this->oHttp->GetQuery('thread');
		// $sThreadAction = $this->oHttp->GetQuery('action');
		// if (0 < strlen($sThread))
		// {
			// $iThreadID = $this->oApiHelpDeskManager->getThreadIdByHash($mHelpdeskIdTenant, $sThread);
			// if (0 < $iThreadID)
			// {
				// $oApiIntegrator->setThreadIdFromRequest($iThreadID, $sThreadAction);
				// $bDoId = true;
			// }
		// }

		// $sActivateHash = $this->oHttp->GetQuery('activate');
		// if (0 < strlen($sActivateHash) && !$this->oHttp->HasQuery('forgot'))
		// {
			// $bRemove = true;
			// $oUser = $this->oApiHelpDeskManager->getUserByActivateHash($mHelpdeskIdTenant, $sActivateHash);
			// /* @var $oUser \CHelpdeskUser */
			// if ($oUser)
			// {
				// if (!$oUser->Activated)
				// {
					// $oUser->Activated = true;
					// $oUser->regenerateActivateHash();

					// if ($this->oApiHelpDeskManager->updateUser($oUser))
					// {
						// $bRemove = false;
						// $oApiIntegrator->setUserAsActivated($oUser);
					// }
				// }
			// }

			// if ($bRemove)
			// {
				// $oApiIntegrator->removeUserAsActivated();
			// }
		// }

	
		// if ($oAuthenticatedAccount && $oAuthenticatedAccount->IdTenant === $mHelpdeskIdTenant)
		// {
			// if (!$bDoId)
			// {
				// $oApiIntegrator->setThreadIdFromRequest(0);
			// }

			// $oApiIntegrator->skipMobileCheck();
			// \CApi::Location('./');
			// return '';
		// }
		
		// $oCoreClientModule = \CApi::GetModule('CoreWebclient');
		// if ($oCoreClientModule instanceof \AApiModule) {
			$sResult = file_get_contents($this->GetPath().'/templates/Index.html');
		// }
		
		if (is_string($sResult))
		{
			$sFrameOptions = \CApi::GetConf('labs.x-frame-options', '');
			if (0 < \strlen($sFrameOptions)) {
				@\header('X-Frame-Options: '.$sFrameOptions);
			}

			$sResult = strtr($sResult, array(
				'{{AppVersion}}' => PSEVEN_APP_VERSION,
				'{{IntegratorDir}}' =>  $oApiIntegrator->isRtl() ? 'rtl' : 'ltr',
				'{{IntegratorLinks}}' => $oApiIntegrator->buildHeadersLink('-helpdesk'),
				'{{IntegratorBody}}' => $oApiIntegrator->buildBody('-helpdesk')
			));
		}
		
		return eval('?>' . $sResult . '<?php;');
	}
}