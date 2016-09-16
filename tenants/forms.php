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
<button data-bind="click: reset" class="btn btn-default">Reset</button>
<!-- ko if: !selectedItem() -->
<form class="form-inline" style="display: inline-block;" method="POST" action="<?php echo $sBaseUrl; ?>">
	<input type="hidden" name="manager" value="tenants"/>
	<input type="hidden" name="action" value="build-themes"/>
	<input type="submit" value="Build common Themes" class="btn btn-danger" />
</form>
<form class="form-inline" style="display: inline-block;" method="POST" action="<?php echo $sBaseUrl; ?>">
	<input type="hidden" name="manager" value="tenants"/>
	<input type="hidden" name="action" value="build-langs"/>

	<input type="submit" value="Build common Langs" class="btn btn-danger" />
</form>
<!-- /ko -->
<!-- ko with: selectedItem -->
<form class="form-inline" style="display: inline-block;" method="POST" action="<?php echo $sBaseUrl; ?>">
	<input type="hidden" name="manager" value="tenants"/>
	<input type="hidden" name="action" value="build-themes"/>
	<input name="name" readonly="true" type="hidden" data-bind="textInput: name;" class="form-control" />

	<input type="submit" value="Build Themes" class="btn btn-danger" data-bind="value: 'Build CSS for: ' + name;" />
</form>
<form class="form-inline" style="display: inline-block;" method="POST" action="<?php echo $sBaseUrl; ?>">
	<input type="hidden" name="manager" value="tenants"/>
	<input type="hidden" name="action" value="build-langs"/>
	<input name="name" readonly="true" type="hidden" data-bind="textInput: name;" class="form-control" />

	<input type="submit" value="Build Langs" class="btn btn-danger" data-bind="value: 'Build Langs for: ' + name;" />
</form>
<form class="form-inline" style="display: inline-block;" method="POST" action="<?php echo $sBaseUrl; ?>">
	<input type="hidden" name="manager" value="tenants"/>
	<input type="hidden" name="action" value="build-js"/>
	<input name="name" readonly="true" type="hidden" data-bind="textInput: name;" class="form-control" />

	<input type="submit" value="Build Js" class="btn btn-danger" data-bind="value: 'Build Langs for: ' + name;" />
</form>
<!-- /ko -->
<fieldset data-bind="with: selectedItem">
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="manager" value="tenants"/>
		<input type="hidden" name="action" value="update"/>

		<h3>Edit item</h3>
		<div class="form-group">
			<label>Id</label>
			<input name="id" readonly="true" type="text" data-bind="textInput: id;" class="form-control" />
		</div>
		<div class="form-group">
			<label>Name</label>
			<input name="name" data-bind="textInput: name" class="form-control" />
		</div>
		<div class="form-group">
			<label>Login</label>
			<input name="login" readonly data-bind="textInput: login" class="form-control" />
		</div>
		<div class="form-group">
			<label>Description</label>
			<input name="description" data-bind="textInput: description" class="form-control" />
		</div>
		<div class="form-group">
			<label>Channel Id</label>
			<input name="channel_id" data-bind="textInput: channel_id" class="form-control" />
		</div>

		<input type="submit" value="Update" class="btn btn-primary" />
	</form>
	<form class="form-inline" method="POST" action="<?php echo $sBaseUrl; ?>">
		
		<h3>Delete item</h3>
		<input type="hidden" name="manager" value="tenants"/>
		<input type="hidden" name="action" value="delete"/>
		<div class="form-group">
			<input name="id" readonly="true" type="text" data-bind="textInput: id;" class="form-control" />
		</div>

		<input type="submit" value="Delete" class="btn btn-danger" />
	</form>
</fieldset>
<fieldset data-bind="if: !selectedItem()">
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input type="hidden" name="manager" value="tenants"/>
		<input type="hidden" name="action" value="create"/>

		<h3>Create item</h3>
		<div class="form-group">
			<label>Channel id</label>
			<input name="channel_id" class="form-control" />
		</div>
		<div class="form-group">
			<label>Name</label>
			<input name="name" class="form-control" />
		</div>
		<div class="form-group">
			<label>Description</label>
			<input name="description" class="form-control" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<input name="password" class="form-control" />
		</div>

		<input type="submit" value="Create" class="btn btn-primary" />
	</form>
</fieldset>