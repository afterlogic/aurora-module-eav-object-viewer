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
<fieldset data-bind="with: selectedItem">
	<label>Edit item</label>
	<form method="POST" action="/adm/">
		<input type="hidden" name="manager" value="accounts"/>
		<input type="hidden" name="action" value="update"/>

		<div class="form-group">
			<label>Id</label>
			<input name="id" readonly="true" type="text" data-bind="textInput: id;" class="form-control" />
		</div>
		<div class="form-group">
			<label>Login</label>
			<input name="login" data-bind="textInput: login" placeholder="Account Login" class="form-control" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<input name="password" data-bind="textInput: password" placeholder="Account Password" class="form-control" />
		</div>

		<input type="submit" value="Update" class="btn btn-primary" />
	</form>
	<form method="POST" action="/adm/">
		<input type="hidden" name="manager" value="accounts"/>
		<input type="hidden" name="action" value="delete"/>
		<div class="form-group">
			<label>Account id</label>
			<input name="id" readonly="true" type="text" data-bind="textInput: id;" class="form-control" />
		</div>

		<input type="submit" value="Delete" class="btn btn-danger" />
	</form>
</fieldset>
<fieldset data-bind="if: !selectedItem()">
	<label>Create item</label>
	<form method="POST" action="/adm/">
		<input type="hidden" name="manager" value="accounts"/>
		<input type="hidden" name="action" value="create"/>

		<div class="form-group">
			<label>User id</label>
			<input name="user_id" placeholder="User Id" class="form-control" />
		</div>
		<div class="form-group">
			<label>Login</label>
			<input name="login" placeholder="Account Login" class="form-control" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<input name="password" placeholder="Account Password" class="form-control" />
		</div>

		<input type="submit" value="Create" class="btn btn-primary" />
	</form>
</fieldset>
