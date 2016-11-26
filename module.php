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
		$oCoreClientModule = \CApi::GetModule('CoreWebclient');
		if ($oCoreClientModule instanceof \AApiModule) {
			$sResult = file_get_contents($this->GetPath().'/templates/Index.html');
		}

		if (is_string($sResult))
		{
			$sFrameOptions = \CApi::GetConf('labs.x-frame-options', '');
			if (0 < \strlen($sFrameOptions)) {
				@\header('X-Frame-Options: '.$sFrameOptions);
			}

//			$oApiIntegrator = \CApi::GetSystemManager('integrator');
//			
//			$sResult = strtr($sResult, array(
//				'{{AppVersion}}' => AURORA_APP_VERSION,
//				'{{IntegratorDir}}' =>  $oApiIntegrator->isRtl() ? 'rtl' : 'ltr',
//				'{{IntegratorLinks}}' => $oApiIntegrator->buildHeadersLink('-eavviewr'),
//				'{{IntegratorBody}}' => $oApiIntegrator->buildBody('-eavviewr')
//			));
		}
		
		return eval('?>' . $sResult . '<?php;');
	}
}