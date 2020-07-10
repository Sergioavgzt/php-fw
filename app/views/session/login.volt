{{ content() }}

<div class="block_authorization">

	{{ form('class': 'form-search') }}

		<div align="center">
			<h2>Авторизация</h2>
		</div>

		<div class="br_inside">

			<div class="bri_row">
				<div class="bri_label">{{ form.label('email') }}</div>
				<div class="bri_input">{{ form.render('email') }}</div>
			</div>

			<div class="bri_row">
				<div class="bri_label">{{ form.label('password') }}</div>
				<div class="bri_input">{{ form.render('password') }}</div>
			</div>
			

			{# {{ form.render('go') }} #}

			<div class="bri_row remember">
				<div class="bri_label"></div>
				<div class="bri_input">
					{{ form.render('remember') }}
					{{ form.label('remember') }}
				</div>
			</div>

			<div class="bri_row button_in">
				<div class="bri_label"></div>
				<div class="bri_input">{{ submit_button("Войти", "class": "bbtn btn-success") }}</div>
			</div>

			{{ form.render('csrf', ['value': security.getToken()]) }}
			
			<!--
			<div class="bri_row forgot">
				<div class="bri_label"></div>
				<div class="bri_input">
					{{ link_to("session/forgotPassword", "Забыли свой пароль?") }}
				</div>
			</div>
			-->
			
		</div>
		
	</form>

</div>