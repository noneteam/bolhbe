<h1>Лейблы</h1>

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Показать список</h3>

		<p>Лейблы носят вспомогательных характер, использыются для получения ддопустимых значениев списков в формах.</p>

		<p>Получить список лейблов можно отправив <code>GET</code> запрос. В запросе должено содержатся название поля из формы, следующий адрес <url>https://api.bolh.be/label/language</url> вернет список языков и их идентификаторы).</p>

		<p>Доступны следующие списки: <code>language</code> <code>level</code> <code>scope</code> <code>certificate</code> <code>diploma</code> <code>employment</code> <code>experience</code> <code>move</code> <code>sex</code> <code>show-phone</code> <code>state</code> <code>time</code> <code>trip</code></p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/label/scope"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Поиск позиций</h3>

		<p>Чтоб получить экземпляр позиции (используемые в вакансях, резюме...) необходимо отправить <code>GET</code> запрос в адресе которого указать фрагмент названия позиции.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/vacancy/position/бух"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Добавление позиции</h3>

		<p>Позиции используются в формах вакансии, форме резюме. Позиции досупны для добавления как авторизованным так и анонимным пользователям.</p>

		<p>Чтоб добавить новую позиции необходимо отправить <code>POST</code> запрос, в теле которого отправляется уникальное название позиции.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "text": "Системный администратор" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/vacancy/position"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Поиск организаций</h3>

		<p>Чтоб получить экземпляр организации (используемые в компания, опыте работы...) необходимо отправить <code>GET</code> запрос в адресе которого указать фрагмент названия организации.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/company/place/газп"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Добавление организации</h3>

		<p>Организации используются в формах компании, опыта работы, вакансий. Организации досупны для добавления как авторизованным так и анонимным пользователям.</p>

		<p>Чтоб добавить новую позиции необходимо отправить POST запрос, в теле которого отправляется уникальное название организации.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "text": "ПАО 'РусГидро'", <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/company/place"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Поиск факультетов</h3>

		<p>Чтоб получить экземпляр факультета (используемые в образовании...) необходимо отправить <code>GET</code> запрос в адресе которого указать фрагмент названия факультета.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/resume/faculty/сель"</url>
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Добавление факультета</h3>

		<p>Факультет используются в формах образования. .</p>

		<p>Чтоб добавить новую позиции необходимо отправить <code>POST</code> запрос, в теле которого отправляется уникальное название факультета.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "text": "Физико-математический" <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/resume/faculty"</url>
</pre>
</div>

</div>