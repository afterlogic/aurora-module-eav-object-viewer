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

	$oManagerApi = \CApi::GetModule('StandardAuth')->GetManager('accounts');
	$aItems = $oManagerApi->getAccountList(0, 0);

//TODO: fix password encoder
foreach ($aItems as &$oItem) {
	$oItem[1] = htmlspecialchars($oItem[1]);
}

?>
<div id="accounts-screen" class="row">
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<th>id</th>
				<th>login</th>
				<th>password</th>
				<th>user id</th>
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
	staticData['accounts_list'] = <?php echo is_array($aItems) ? json_encode($aItems) : '[]'; ?>;
</script>
<script src="accounts/accounts.js"></script>

