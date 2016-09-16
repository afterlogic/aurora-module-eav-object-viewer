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

if ($sAuthToken) { ?>
	<div>CSRF TOKEN: <?php echo $sToken; ?></div>
	<div>AUTH TOKEN: <?php echo $sAuthToken; ?></div>
	<div>USER ID: <?php echo $iUserId; ?></div>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input name="manager" type="hidden" value="auth" class="form-control" />
		<input name="action" type="hidden" value="logout" class="form-control" />

		<input type="submit" value="Logout" />
	</form>
<?php } else { ?>
<fieldset>
	<label>Login</label>
	<form method="POST" action="<?php echo $sBaseUrl; ?>">
		<input name="manager" type="hidden" value="auth" class="form-control" />
		<!--<input name="Method" type="text" value="Login2" class="form-control" />-->
		<input name="action" type="hidden" value="login" class="form-control" />

		<input name="login" type="text" class="form-control" />
		<input name="password" type="text" class="form-control" />

		<input type="submit" value="Login" />
	</form>
</fieldset>
<?php } ?>
