<h1>География</h1>


<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Формы географии</h3>

		<p>Чтоб добавить новую запись необходимо отправить <code>POST</code> запрос, в теле которого отправляется уникальное название региона или города.</p>

		<p>Возможные названия модуля в адресной строк: <code>region</code> <code>city</code></p>

		<p><b>Внимание.</b> Добавлять записи через формы географии могут как авторизованные так и анонимные пользователи.</p>
	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>POST</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	-d '<b>{ <i>\</i>
		 "text": "Республика Ингушетия", <i>\</i>
	    }</b>' <i>\</i>
	<url>"https://api.bolh.be/location/region"</url>
#	Пример адреса для города
#	"https://api.bolh.be/location/city"
</pre>
</div>
</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Поиск регионов и городов</h3>

		<p>Чтоб получить экземпляр региона или города необходимо отправить <code>GET</code> запрос в адресе которого указать фрагмент названия региона или города.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/location/region/ингу"</url>
#	Пример адреса для города
#	"https://api.bolh.be/location/city/назра"
</pre>
</div>

</div>

<hr />

<div class="row">

	<div class="col-lg-5 pull-right">

		<h3>Определить по IP</h3>

		<p>Определение региона и города возможно на основании IP-адреса клиента. Осуществляется отправкой <code>GET</code> запроса.</p>

	</div>

<div class="col-lg-7">
<pre>
curl -v <i>\</i>
	-X <verb>GET</verb> <i>\</i>
	-H 'Content-Type: application/json' <i>\</i>
	<url>"https://api.bolh.be/location"</url>
</pre>
</div>

</div>