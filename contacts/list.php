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

$oContactsDecorator = \CApi::GetModuleDecorator('Contacts');

$aGroups = $oContactsDecorator->GetGroups(
	60
);


var_dump($aGroups);

//	$oManagerApi = \CApi::GetModule('Conacts')->GetManager('main');
//	$aItems = $oManagerApi->getAccountList(0, 0);
//	
//	$oManagerApi = \CApi::GetModule('Conacts')->GetManager('main');
//	$aItems = $oManagerApi->getAccountList(0, 0);
	
//	\CApi::ExecuteMethod('Contacts::GetGroups', array(
//		'Token' => $sToken,
//		'AuthToken' => $sAuthToken,
//		'IdUser' => $oHttp->GetPost('user_id', ''),
//		'Login' => $oHttp->GetPost('login', ''),
//		'Password' => $oHttp->GetPost('password', '')
//	));
?>
<div id="contacts-screen" class="row">
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<th>id</th>
				<th>login</th>
				<th>password</th>
				<th>user id</td>
			</tr>
			<!-- ko foreach: usersList -->
			<tr data-bind="click: $parent.selectItem.bind($parent), css: {'success': active}">
				<td data-bind="text: id;"></td>
				<td data-bind="text: login"></td>
				<td data-bind="text: password"></td>
				<td data-bind="text: user_id"></td>
			</tr>
			<!-- /ko -->
		</table>
	</div>
	<div class="col-sm-6">
		<?php include "forms.php"; ?>
	</div>
</div>
<script>
	staticData['contacts_list'] = <?php echo is_array($aItems) ? json_encode($aItems) : '[]'; ?>;
	staticData['contacts_groups'] = <?php echo is_array($aContactGrouns) ? json_encode($aContactGrouns) : '[]'; ?>;
</script>
<script src="contacts/contacts.js"></script>

