
<?php
$username = array('name' => 'username', 'placeholder' => 'Email');
$password = array('name' => 'password',    'placeholder' => 'Tu password');
$name = array('name' => 'name', 'placeholder' => 'Nombre');
$phone = array('name' => 'phone', 'placeholder' => 'Telefono');
$submit = array('name' => 'submit', 'value' => 'Crear cuenta e Iniciar sesión', 'title' => 'Crear cuenta e Iniciar sesión');






?>



	

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
		
			
			Crear Cuenta<br /><br />
			
			<?php echo form_open(base_url().'nlogin/new_user')?>
			<table border="0"  style="width: 320px;">
			<tr>
				<td>
					<label for="username">Email:</label>
				</td>
				<td>
					<?php echo form_input($username)?>
					<p>
						<?=form_error('username')?>
					</p>
				</td>
				
				
				
			</tr>
			
			<tr>
				<td>
					<label for="password">Tu password:</label>
				</td>
				<td>
					<?php  echo form_password($password)?>
					<p>
					<?=form_error('password')?>
					</p>
					<?php echo  form_hidden('token',$token)?>
				</td>

			<tr>
				<td>
					<label for="username">Nombre:</label>
				</td>
				<td>
					<?php echo form_input($name)?>
					<p>
						<?=form_error('name')?>
					</p>
				</td>
				
				
				
			</tr>

			<tr>
				<td>
					<label for="username">Telefono:</label>
				</td>
				<td>
					<?php echo form_input($phone)?>
					<p>
						<?=form_error('phone')?>
					</p>
				</td>
				
				
				
			</tr>
				
				
				
			</tr>
			
			<tr>
				<td>
					<?php echo form_submit($submit)?>
				</td>
				<td>
					&nbsp;
				</td>
				
				
				
			</tr>
			
			</table>
			<?php echo form_close()?>

			
			
			
			
			
			
			
			
			
			
			
			
			

			
		</div>
	</div>

