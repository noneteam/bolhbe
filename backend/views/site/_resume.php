<h1>Резюме</h1>


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Список резюме</h3>

		<p>Получить список можно отправкой <code>GET</code> запроса. Запрос возвращает сам список резюме, информацию о пагинации и список доступных фильтров.</p>

		<p>Список может быть отфильтрован по следующим полям <code>page</code> <code>region</code> <code>city</code> <code>employment</code> <code>state</code> <code>sex</code> <code>scope</code> которые отправляются в адресе запроса.</p>

		<p><b>Внимание.</b> Посмотрите как получить доступные значения в разеде "Лейблы".</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/resume"</url>
</pre>
</div>

</div>



<h3>Форма резюме</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "positions": [ <i>\</i>
		   { <i>\</i>
		      "text": "Учитель математики", <i>\</i>
		      "id": 126 <i>\</i>
		   }, <i>\</i>
		   { <i>\</i>
		      "text": "Учитель физики", <i>\</i>
		      "id": 300 <i>\</i>
		   } <i>\</i>
		 ], <i>\</i>
		 "salary": "50000", <i>\</i>
		 "employment": { <i>\</i>
		   "text": "Полный день", <i>\</i>
		   "id": 6 <i>\</i>
		 }, <i>\</i>
		 "move": { <i>\</i>
		   "text": "Желателен", <i>\</i>
		   "id": 3 <i>\</i>
		 }, <i>\</i>
		 "trip": { <i>\</i>
		   "text": "Готов", <i>\</i>
		   "id": 2 <i>\</i>
		 }, <i>\</i>
		 "time": { <i>\</i>
		   "text": "Менее 30 минут", <i>\</i>
		   "id": 2 <i>\</i>
		 }, <i>\</i>
		 "scope": { <i>\</i>
		   "text": "Образование, наука", <i>\</i>
		   "id": 20 <i>\</i>
		 } <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/resume"</url>
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>

<h3>Форма опыта работы</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT \
# В случане обновления тип запроса сменится на 'PUT'
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "position": { <i>\</i>
		   "text": "Медицинская сестра", <i>\</i>
		   "id": 41 <i>\</i>
		 }, <i>\</i>
		 "place": { <i>\</i>
		   "text": "Джейрахская районная больница", <i>\</i>
		   "id": 245 <i>\</i>
		 }, <i>\</i>
		 "region": { <i>\</i>
		   "text": "Республика Ингушетия", <i>\</i>
		   "id": 6 <i>\</i>
		 }, <i>\</i>
		 "scope": { <i>\</i>
		   "text": "Медицина, фармацевтика", <i>\</i>
		   "id": 22 <i>\</i>
		 }, <i>\</i>
		 "content": "Не стандартизируемая инфа.", <i>\</i>
		 "hired": "2011-09" <i>\</i>
	    }</b> <i>\</i>'
	<url>"https://api.bolh.be/resume/experience"</url>
#	"https://api.bolh.be/resume/experience/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>

<h3>Форма образования</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT \
# В случане обновления тип запроса сменится на 'PUT'
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "specialty": { <i>\</i>
		   "text": "Бухгалтер-экономист", <i>\</i>
		   "id": 298 <i>\</i>
		 }, <i>\</i>
		 "title": { <i>\</i>
		   "text": "Чечено-Ингушский государственный университет (ЧИГУ)", <i>\</i>
		   "id": 332 <i>\</i>
		 }, <i>\</i>
		 "level": { <i>\</i>
		   "text": "Высшее", <i>\</i>
		   "id": 8 <i>\</i>
		 }, <i>\</i>
		 "diploma": { <i>\</i>
		   "text": "средняя 5", <i>\</i>
		   "id": 4 <i>\</i>
		 }, <i>\</i>
		 "faculty": { <i>\</i>
		   "text": "Медицинский", <i>\</i>
		   "id": 77 <i>\</i>
		 } <i>\</i>
	    }</b>'
	<url>"https://api.bolh.be/resume/university"</url>
#	"https://api.bolh.be/resume/university/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>

<h3>Форма курсов</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT \
# В случане обновления тип запроса сменится на 'PUT'
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "text": "Курсы офисного делопроизводства", <i>\</i>
		 "company_place": { <i>\</i>
		   "text": "Учебно-методический центр ООО 'СПЕКТР'", <i>\</i>
		   "id": 302 <i>\</i>
		 }, <i>\</i>
		 "certificate": { <i>\</i>
		   "text": "Сертификат", <i>\</i>
		   "id": 2 <i>\</i>
		 } <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/resume/course"</url>
#	"https://api.bolh.be/resume/course/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>

<h3>Форма иностарнных языков</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT \
# В случане обновления тип запроса сменится на 'PUT'
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{ <i>\</i>
		 "language": { <i>\</i>
		   "text": "Английский", <i>\</i>
		   "id": 5 <i>\</i>
		 }, <i>\</i>
		 "level": { <i>\</i>
		   "text": "Cвободно владею", <i>\</i>
		   "id": 4 <i>\</i>
		 } <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/resume/language"</url>
#	"https://api.bolh.be/resume/language/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>

<h3>Форма пройденных тестов</h3>

<div class="row">
<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
#	-X PUT \
# В случане обновления тип запроса сменится на 'PUT'
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-d '<b>{
		 "text": "Экзаменационная работа по окончании курса делопроизви", <i>\</i>
		 "company_place": { <i>\</i>
		   "text": "Учебно-методический центр ООО 'СПЕКТР'", <i>\</i>
		   "id": 302 <i>\</i>
		 }, <i>\</i>
	    }</b>'
	<url>"https://api.bolh.be/resume/test"</url>
#	"https://api.bolh.be/resume/test/246"
# URI при 'PUT' запросе содержит идентификатор
</pre>
</div>
<div class="col-lg-5">*
</div>
</div>


<div class="row">

<div class="col-lg-5 pull-right">

	<h3>Статус резюме</h3>

	<p>Статус резюме меняется <code>PUT</code> запросом, в теле которого отправляется объект <code>{'state': {'id': значение}}</code>.</p>

	<p>Резюме может быть в двух состояниях ("Сейчас свободен", "Сейчас занят"), для переключения состояния полю id доступны два значения <code>1</code> <code>2</code> соответственно.</p>

</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>PUT</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	-H '<b>Set-Model: ResumeState</b>' <i>\</i>
	-d '<b>{
		 "state": { <i>\</i>
		   "text": "Сейчас занят", <i>\</i>
		   "id": 2 <i>\</i>
		 }, <i>\</i>
	    }</b>'

	<url>"https://api.bolh.be/resume"</url>
</pre>
</div>

</div>


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Удаление резюме</h3>

		<p>Удаление осуществляется отправкой <code>DELETE</code> запроса. В заголовке должен присутствовать <code>Authorization</code>.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	<url>"https://api.bolh.be/resume"</url>
</pre>
</div>

</div>


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Удаление записи из подмодуля резюме</h3>

		<p>Чтоб удалить запись из подмодуля резюме необходимо отправить <code>DELETE</code> запрос. В адресе запроса должены содержаться название подмодуля и идентификатор записи.</p>

		<p>Доступные названия подмодулей: <code>course</code> <code>test</code> <code>language</code> <code>experience</code> <code>university</code></p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>DELETE</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-H '<b>Authorization: Bearer so3i7fl8kc98vw489jfwe</b>' <i>\</i>
	<url>"https://api.bolh.be/resume/course/246"</url>
</pre>
</div>

</div>