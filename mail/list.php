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

	$aItems = [];
	$oModule = \CApi::GetModule('Mail');
	if (!empty($oModule))
	{
		$oManagerApi = \CApi::GetModule('Mail')->GetManager('accounts');
		$aItems = $oManagerApi->getAccountList(0, 0);
	}
?>
<div id="mail-screen" class="row">
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<th>id</th>
				<th>email</th>
				<th>password</th>
				<th>server</th>
				<th>default</th>
				<th>user id</th>
			</tr>
			<!-- ko foreach: mailAccountsList -->
			<tr data-bind="click: $parent.selectItem.bind($parent), css: {'success': active}">
				<td data-bind="text: id;"></td>
				<td data-bind="text: email"></td>
				<td data-bind="text: password"></td>
				<td data-bind="text: server"></td>
				<td data-bind="text: is_default"></td>
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
	staticData['mail_accounts_list'] = <?php echo is_array($aItems) ? json_encode($aItems) : '[]'; ?>;
</script>
<script src="mail/accounts.js"></script>
