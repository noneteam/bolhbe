<h1>Вакансия</h1>


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Список вакансий</h3>

		<p>Получить список можно отправкой <code>GET</code> запроса. Запрос возвращает сам список вакансий, информацию о пагинации и список доступных фильтров.</p>

		<p>Список может быть отфильтрован по следующим полям <code>page</code> <code>user</code> <code>region</code> <code>city</code> <code>employment</code> <code>experience</code> <code>scope</code> которые отправляются в адресе запроса.</p>

		<p><b>Внимание.</b> Посмотрите как получить доступные значения в разеде "Лейблы".</p>

	</div>


<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/vacancy?scope=39"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Просмотр вакансии</h3>

		<p>Получение вакансии происхоит отправкой <code>GET</code> запроса, в адресе должен содержаться числовой идентификатор вакансии.</p>

		<p><b>Внимание.</b> Показываются только активные вакансии. Вакансии с истекшим сроком или скрытые доступны только автору.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/vacancy/157"</url>
</pre>
</div>

</div>

<hr />


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Удаление вакансии</h3>

		<p>Удаление осуществляется отправкой <code>DELETE</code> запроса, в адресе должен содержаться идентификатор вакансии. Запрос проверяется на авторские привелегии на основании заголовка <code>Authorization</code>.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	<url>"https://api.bolh.be/vacancy/246"</url>
</pre>
</div>
</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Формы вакансии</h3>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT <i>\</i>
# В случане обновления тип запроса сменится на 'PUT'
#	-H 'Authorization: Bearer so3i7fl8kc98vw489jfwe' <i>\</i>
# Так же обязательно подкрепить запрос пользователем
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "position": { <i>\</i>
		   "id": "149", <i>\</i>
		   "text": "Маркетолог" <i>\</i>
		 }, <i>\</i>
		 "company_place": { <i>\</i>
		   "id": "1", <i>\</i>
		   "text": "Нет названия" <i>\</i>
		 }, <i>\</i>
		 "experience": { <i>\</i>
		   "text": "Без опыта", <i>\</i>
		   "id": 1 <i>\</i>
		 }, <i>\</i>
		 "employment": { <i>\</i>
		   "text": "Полная занятость", <i>\</i>
		   "id": 1 <i>\</i>
		 }, <i>\</i>
		 "scope": { <i>\</i>
		   "text": "Маркетинг, реклама, PR", <i>\</i>
		   "id": 10 <i>\</i>
		 }, <i>\</i>
		 "region": { <i>\</i>
		   "text": "Республика Ингушетия", <i>\</i>
		   "id": 6 <i>\</i>
		 }, <i>\</i>
		 "city": { <i>\</i>
		   "text": "Назрань", <i>\</i>
		   "id": 1 <i>\</i>
		 }, <i>\</i>
		 "content": "Не стандартизируемая инфа.", <i>\</i>
		 "salary": "22600", <i>\</i>
		 "phone": "9123456789" <i>\</i>
		}</b>' <i>\</i>
	<url>"https://api.bolh.be/vacancy"</url>
#	"https://api.bolh.be/vacancy/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Смена состояния вакансии</h3>

		<p>Вакансия может находиться в 3 состояниях (публичная, черновик, истекшая по сроку). Переключение производится отправкой <code>PUT</code> запроса, в заголовке которого указывается необходимое состояние.</p>

		<p>Доступные состояния: <code>VacancyShow</code> <code>VacancyHide</code> <code>VacancyProlong</code>.</p>

		<p><b>Внимание.</b> Состояние <code>VacancyProlong</code> доступно только для вакансий с истекшим сроком, аналогично <code>VacancyShow</code> и <code>VacancyHide</code> противопоставляются друг другу статусом.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H 'Set-Model: VacancyHide' <i>\</i>
	<url>"https://api.bolh.be/vacancy/246"</url>
</pre>
</div>

</div>

