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

	$oManagerApi = \CApi::GetModule('Core')->GetManager('channels');
	$aResultChannels = $oManagerApi->getChannelList();
	$aItems = array();
	foreach($aResultChannels as $oChannel)
	{
		$aItems[$oChannel->iId] = array(
			$oChannel->Login,
			$oChannel->Description,
			$oChannel->Password
		);
	}
	
?>
<div id="channels-screen" class="row">
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<th>id</th>
				<th>login</th>
				<th>description</th>
			</tr>
			<!-- ko foreach: usersList -->
			<tr data-bind="click: $parent.selectItem.bind($parent), css: {'success': active}">
				<td data-bind="text: id;"></td>
				<td data-bind="text: login"></td>
				<td data-bind="text: description"></td>
			</tr>
			<!-- /ko -->
		</table>
	</div>
	<div class="col-sm-6">
		<?php include "forms.php"; ?>
	</div>
</div>
<script>
	staticData['channels_list'] = <?php echo is_array($aItems) ? json_encode($aItems) : '[]'; ?>;
</script>
<script src="channels/channels.js"></script>

