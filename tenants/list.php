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

	$oManagerApi = \CApi::GetModule('Core')->GetManager('tenants');
	$aTenants = $oManagerApi->getTenantList(0, 0);
	$aItems = array();
	foreach($aTenants as $oTenat)
	{
		$aItems[$oTenat->iId] = array(
			$oTenat->Name,
			$oTenat->Description,
			$oTenat->IdChannel
		);
	}
?>
<div id="tenants-screen" class="row">
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<th>id</th>
				<th>name</th>
				<th>login</th>
				<th>description</th>
				<th>channel id</td>
			</tr>
			<!-- ko foreach: usersList -->
			<tr data-bind="click: $parent.selectItem.bind($parent), css: {'success': active}">
				<td data-bind="text: id;"></td>
				<td data-bind="text: name"></td>
				<td data-bind="text: login"></td>
				<td data-bind="text: description"></td>
				<td data-bind="text: channel_id"></td>
			</tr>
			<!-- /ko -->
		</table>
	</div>
	<div class="col-sm-6">
		<?php include "forms.php"; ?>
	</div>
</div>
<script>
	staticData['tenants_list'] = <?php echo is_array($aItems) ? json_encode($aItems) : '[]'; ?>;
</script>
<script src="tenants/tenants.js"></script>

