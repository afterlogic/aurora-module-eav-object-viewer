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
?>
<!--<button data-bind="click: reset" class="btn btn-default">Reset</button>-->
<div data-bind="with: propsList">
	<label>Create item</label>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="ObjectName" data-bind="value: $parent.selectedObjectName"/>
		<input type="hidden" name="manager" value="objects" />
		<input type="hidden" name="action" value="create"/>

		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<!-- ko foreach: $parent.propsList -->
					<th  data-bind="text: $data;"></th>
					<!-- /ko -->
				</tr>
				<tr class="form-group">
					<!-- ko foreach: $data -->
					<td>
						<input type="text" class="form-control" data-bind="attr: {'name': $parents[1].propsList()[$index()]}" style="min-width: 100px;" />
					</td>
					<!-- /ko -->
				</tr>
			</table>
		</div>
		<input type="submit" value="Create" class="btn btn-danger" />
	</form>
</div>

<div data-bind="with: selectedItem">
	<br />
	<label>Edit item</label>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="ObjectName" data-bind="value: $parent.selectedObjectName"/>
		<input type="hidden" name="manager" value="objects" />
		<input type="hidden" name="action" value="edit"/>
		
		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<!-- ko foreach: $parent.propsList -->
					<th  data-bind="text: $data;"></th>
					<!-- /ko -->
				</tr>
				<tr class="form-group">
					<!-- ko foreach: $data -->
					<td>
						<input type="text" data-bind="value: $data, attr: {'name': $parents[1].propsList()[$index()]}" class="form-control" style="min-width: 100px;" />
						<!--<input type="text" data-bind="value: $data, attr: console.log($index())" class="form-control" />-->
					</td>
					<!-- /ko -->
				</tr>
			</table>
		</div>
		<input type="submit" value="Update" class="btn btn-danger" />
	</form>
</div>
<!--<div data-bind="with: selectedItem">
	<label>Delete item</label>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="manager" value="objects"/>
		<input type="hidden" name="action" value="delete"/>
		<div class="form-group">
			<label>Object id</label>
			<input name="iObjectId" type="text" data-bind="textInput: $data[0];" class="form-control" />
		</div>

		<input type="submit" value="Delete" class="btn btn-danger" />
	</form>
</div>-->
<div data-bind="with: checkedItems().length > 0">
	<br />
	<label>Delete items</label>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="manager" value="objects" />
		<input type="hidden" name="action" value="delete_multiple" />
		<input type="hidden" name="ids" data-bind="textInput: $parent.checkedItems().join(',');" />

		<input type="submit" value="Delete" class="btn btn-danger" data-bind="value: 'Delete: '+ $parent.checkedItems().join(', ');" />
	</form>
</div>
