<h1>Пользователь</h1>

<div class="row">

	<div class="col-md-5 pull-right">

		<h3>Авторизация</h3>

		<p>Чтоб войти на сайт пользователь отправляет (<code>POST</code> запрос) контрольные данные <code>телефон</code> и <code>пароль</code>, в ответ получает токен.</p>

		<p>Токен используется в заголовках запросов для идентификации пользователя.</p>

		<p><b>Внимание.</b> Форма входа доступна только для анонимного пользователя, а выход для авторизаванного. Авторизованность пользователя проверяется наличием специального заголовка <code>Authorization</code></p>

		<p>Помимо стандартной авторизации через форму, есть возможность авторизации через социальные сети. Для этого нужно перейти по адресу - <url>https://api.bolh.be/user/auth?authclient=facebook</url>.</p>

	</div>

	<div class="col-md-7">
<pre>
<small class="pull-right">Вход</small>curl -v <i>\</i>
	-X <verb><verb>POST</verb></verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9123456789", <i>\</i>
		 "password": "secret" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user/gate"</url>
</pre>
<pre>
<small class="pull-right">Выход</small>curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	<url>"https://api.bolh.be/user/gate"</url>
</pre>
	</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Восстановление пароля</h3>

		<p><b>Внимание.</b> Процесс сброса пароля проходит в два шага.</p>

		<ol>
			<li>Первым делом нужно получить токен для сброса пароля, для этого отправляется <code>POST</code> запрос. В теле запроса сначала отправляется номер телефона пользователя. В результате пользователь получает смс-прокецию, форма отправляется повторно предварительно дополненная полем смс-протекции.</li>
			<li>В случае успешного выполнения запроса, пользователь получает токен. Данный токен подставляется в заголовк второго <code>PATCH</code> запроса, в теле которого отправляется новый пароль.</li>
		</ol>

		<p>В случае успешного выполнения обоих действий пароль будет сменен на пароль указанный во второй форме. Так же Пользователь получает токен для авторизации.</p>

	</div>
<div class="col-lg-7">
<pre>
<small class="pull-right">Шаг 1</small>curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9123456789", <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user/password"</url>
</pre>
<pre>
<small class="pull-right">Шаг 2</small>curl -v <i>\</i>
	-X <verb>PATCH</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Token: secretToken</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "password": "newSecret" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user/password"</url>
</pre>
</div>


</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Смена пароля</h3>

		<p>Смена пароля для авторизованного пользователя осущаетвляется отправкой <code>PUT</code> запроса. В теле запроса должны присутствовать два пароля, текущий и новый.</p>

		<p><b>Внимание.</b> Текущий пароль проходит проверку на достоверность.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "password": "oldSecret", <i>\</i>
		 "password_new": "newSecret" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user/password"</url>
</pre>
</div>

</div>

<hr />

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-H '<b>Set-Model: PhoneUpdateForm</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9012345678", <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

	<div class="col-lg-5">
		<h3>Смена телефона</h3>
	</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Видимость телефона</h3>

		<p>Переключение состояние осуществляется отправкой <code>PUT</code> запроса авторизованным пользователем, в теле запроса отправляется объект <code>{'show_phone': {'id': значение}}</code>.</p>

		<p>Указанный пользователем телефон может быть в трех состояниях видимости ("Всем пользователям", "Только зарегистрированным", "Только пригласившим"). Для переключения состояния полю <code>id</code> доступны три значения <code>1</code> <code>2</code> <code>3</code> соответственно.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-H '<b>Set-Model: PhoneAvailabilitySet</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "show_phone": { <i>\</i>
		   "id": "3", <i>\</i>
		   "text": "Всем пользователям" <i>\</i>
		 } <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

</div>

<hr />

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-H '<b>Set-Model: PhoneConnectForm</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9012345678", <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

	<div class="col-lg-5">
		<h3>Подкрепить профиль телефоном</h3>
	</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Регистрация</h3>

		<p>Пользователь на сайте может зарегистрироваться двумя способами. Оба способа осуществляется отправкой <code>POST</code> запроса.</p>

		<p><b>Способ 1.</b> Пользователь отправляет номер телефона, который проверяется на уникальность. В случае успеха пользователь получает на указанный телефон смс-протекцию, которую отправляет в повторном запросе на тот же адрес.</p>

		<p>Поле пароль опциональное, если его не задавать паролем будет задана смс-протекция.</p>

		<p><b>Способ 2.</b> Логика второго способа подобна первой, за исключением того что количество обязательных полей больше. Пользователь указывает профильные данные и выбирает псевдо роль.</p>

		<p>Роль можно использовать для дальнейшего сопровождения пользователя (например предлагать создать резюме).</p>

		<p>Для переключение способов регистрации в запросе используется заголовок <code>Set-Model</code>.</p>

		<p>Результатом успешного запроса будет получение токена, используя который пользователь получает авторизацию.</p>

	</div>

<div class="col-lg-7">
<pre>
<small class="pull-right">Быстрая</small>curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9123456789", <i>\</i>
		 "password": "secret", <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
<pre>
<small class="pull-right">Стандартная</small>curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Set-Model: SignupFormExtra</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "phone": "9123456789", <i>\</i>
		 "password": "secret", <i>\</i>
		 "name": "Руслан", <i>\</i>
		 "family": "Сакалов", <i>\</i>
		 "role": "worker", <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

</div>

<hr />

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "name": "Руслан", <i>\</i>
		 "family": "Сакалов", <i>\</i>
		 "birthday": "1987-09-27", <i>\</i>
		 "sex": { <i>\</i>
		   "id": "1", <i>\</i>
		   "text": "Мужчина" <i>\</i>
		 }, <i>\</i>
		 "region": { <i>\</i>
		   "id": "6", <i>\</i>
		   "text": "Руспублика Ингушетия" <i>\</i>
		 } <i>\</i>
		 "city": { <i>\</i>
		   "id": "1", <i>\</i>
		   "text": "Назрань" <i>\</i>
		 }, <i>\</i>
		 "email": "sakalovruslan@gmail.com", <i>\</i>
		 "facebookcom": "facebook_profile_id", <i>\</i>
		 "youtubecom": "youtubecom_profile_id", <i>\</i>
		 "twittercom": "twittercom_profile_id", <i>\</i>
		 "vkcom": "vkcom_profile_id", <i>\</i>
		 "okru": "okru_profile_id", <i>\</i>
		 "skype": "skype_profile_id" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

	<div class="col-lg-5">
		<h3>Редактирование профиля</h3>
	</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Просмор пользователя</h3>

		<p>Просмот профиля осуществляется отправкой <code>GET</code> запроса. В адресе запроса должен присутствовать числовой идентификатор пользователя.</p>

		<p><b>Внимание.</b> Чтоб получить профиль авторизованного пользователя идентификатор равен <code>0</code>, так же в запросе должен присутствовать заголовок <code>Authorization</code>.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/user/369"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Удаление пользователя</h3>

		<p>Удаление осуществляется отправкой двух <code>DELETE</code> запросов. В результате первого пользователь получает на телефон из профиля смс-протекцию, которую отправляет в теле повторного запроса.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "protect": "0123" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/user"</url>
</pre>
</div>

</div>