<h1>Компания</h1>

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Список компаний</h3>

		<p>Получить список можно отправкой <code>GET</code> запроса. Запрос возвращает сам список компаний, информацию о пагинации и список доступных фильтров.</p>

		<p>Список может быть отфильтрован по следующим полям <code>page</code> <code>region</code> <code>city</code> <code>scope</code> которые отправляются в адресе запроса.</p>

		<p><b>Внимание.</b> Посмотрите как получить доступные значения в разеде "Лейблы".</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/company"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Форма компании</h3>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "title": { <i>\</i>
		   "text": "Кондитерская 'Арабика'", <i>\</i>
		   "id": 327 <i>\</i>
		 }, <i>\</i>
		 "content": "Не стандартизируемая инфа.", <i>\</i>
		 "scope": { <i>\</i>
		   "text": "Рестораны, фастфуд", <i>\</i>
		   "id": 14 <i>\</i>
		 } <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/company"</url>
</pre>
</div>

</div>

<hr />


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Удаление компании</h3>

		<p>Удаление осуществляется отправкой <code>DELETE</code> запроса. В заголовке должен присутствовать <code>Authorization</code>.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	<url>"https://api.bolh.be/company"</url>
</pre>
</div>

</div>

