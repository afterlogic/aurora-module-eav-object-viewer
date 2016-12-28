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

	$oManagerApi = \CApi::GetSystemManager('eav', 'db');
	$aTypes = $oManagerApi->getTypes();
?>
<div id="objects-screen" class="row">
	<div class="col-sm-12">
		<br />
		<br />
		<ul id="object-tabs" class="nav nav-tabs" role="tablist" data-bind="foreach: objectTypes">
			<li role="presentation" class="<?php //echo $iStoredTab === 6 ? 'active' : ''?>"><a href="#ajax" aria-controls="ajax" role="tab" data-toggle="tab" data-bind="text: $data, attr: {'href': '#object-'+$data}, click: $parent.switchTab"></a></li>
		</ul>
		<div class="tab-content" data-bind="foreach: objectTypes">
			<div role="tabpanel" class="table-responsive tab-pane" id="" data-bind="attr: {'id': 'object-'+$data}">
				<table class="table table-striped">
					<tr>
						<th>
							<input type="checkbox" name="test" />
						</th>
						<!-- ko foreach: $parent.propsList -->
						<th data-bind="text: $data"></th>
						<!-- /ko -->
					</tr>
					<!-- ko foreach: $parent.objectsList -->
					<tr data-bind="click: $parents[1].selectItem, css: {'warning': $parents[1].selectedItem() == $data, 'info': _.contains($parents[1].checkedItems(), $data[0])}">
						<th>
							<input type="checkbox" class="checkbox" name="test" data-bind="click: $parents[1].checkItem, checked: _.contains($parents[1].checkedItems(), $data[0])" />
						</th>
						<!-- ko foreach: $data -->
							<th nowrap data-bind="text: $data;"></th>
					<!-- /ko -->
					</tr>
					<!-- /ko -->
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<?php include "forms.php"; ?>
	</div>
</div>
<script>
	staticData['objects'] = <?php echo is_array($aTypes) ? json_encode($aTypes) : '[]'; ?>;
	$('#object-tabs')
		.click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
		//.on('shown.bs.tab', function (e) {
		//	var index = $(this).children().index($(e.target).parent());
		//	document.cookie = "OBJECT_TAB="+index;
		//});
</script>
<script src="modules/EavObjectViewer/objects/objects.js"></script>

