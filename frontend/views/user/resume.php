<?php

use yii\helpers\Html;

$positions = [];
if ($model->resume)
	foreach ($model->resume['positions'] as $key => $value)
		array_push($positions, $value['position']['text']);

$positions = implode(', ', $positions);

?>

<?= Html::tag('h2', $positions, [
	'itemprop' => 'jobTitle'
]) ?>

<ul>
	<li>
		Контактная информация:
		<ul>
			<?= Html::tag('li', "{$model->profile['name']} {$model->profile['family']}", [
				'itemprop' => 'name'
			]) ?>
			<li>
				<?= Html::tag('span', "+7{$model->getPhone()}", [
					'itemprop' => 'telephone'
				]) ?>
			</li>
			<?= $model->profile['email'] ? Html::tag('li', Html::a($model->profile['email'], "mailto:{$model->profile['email']}", [
				'itemprop' => 'email'
			])) : null ?>
		</ul>
	</li>
	<li itemprop="address" itemscope itemtype="http://schema.org/Place">
		Местонахождения:
		<?= Html::a($model->profile['region']['text'], ['resume/index', 'region' => $model->profile['region']['id']], [
			'itemprop' => 'addressRegion'
		]) ?> &rarr; 
		<?= Html::a($model->profile['city']['text'], ['resume/index', 'region' => $model->profile['region']['id'], 'city' => $model->profile['city']['id']], [
			'itemprop' => 'addressLocality'
		]) ?>
	</li>
</ul>


<?= Html::tag('h3', 'Образование') ?>


<div itemscope itemtype="http://schema.org/ItemList">
	<?php if ($model->resume) foreach ($model->resume['university'] as $key => $value) { ?>
		<div itemprop="itemListElement">

			<ul itemprop="alumniOf" itemscope itemtype="http://schema.org/CollegeOrUniversity">

				<li>
					Учебное заведение: <?= Html::tag('span', $value['title']['text'], [
						'itemprop' => 'name'
					]) ?>
				</li>
				<li>
					Специализация: <?= Html::tag('span', $value['specialty']['text'], [
					]) ?>
				</li>
				<?= Html::tag('li', 'Степень: '. $value['level']['text']) ?>
				<?= Html::tag('li', 'Средняя оценка: ' . $value['diploma']['text']) ?>

			</ul>

		</div>

	<?php } ?>
</div>

<?= Html::tag('h3', 'Опыт работы') ?>

<div itemscope itemtype="http://schema.org/ItemList">
	<?php if ($model->resume) foreach ($model->resume['experience'] as $key => $value) { ?>
		<div itemprop="itemListElement">

			<ul itemscope itemprop="worksFor" itemtype="http://schema.org/Organization">

				<li>
					Организация: <?= Html::tag('span', $value['place']['text'], [
						'itemprop' => 'name'
					]) ?>
				</li>
				<li itemprop="location" itemscope itemtype="http://schema.org/Place">
					<?= Html::a($value['region']['text'], ['company/index', 'region' => $value['region']['id']], [
						'itemprop' => 'addressRegion'
					]) ?>
				</li>

			</ul>
			<ul itemscope itemtype="http://schema.org/Event/Job">

				<li>
					Должность: <?= Html::tag('span', $value['position']['text'], [
						'itemprop' => 'name'
					]) ?>
				</li>
				<li>
					<?= Html::tag('strong', 'Направление работы:') ?> 
					<?= Html::tag('span', $value['scope']['text']) ?>
				</li>
				<li>
					<?= Html::tag('strong', 'Дата принятия на работу:') ?> 
					<?= Html::tag('span', $value['hired'], [
						'itemprop' => 'startDate',
						//'content' => '2004-01-21T20:00'
					]) ?>
				</li>
				<li>
					<?= Html::tag('strong', 'Дата уволенения:') ?> 
					<?= Html::tag('span', $value['dismissed'], [
						'itemprop' => 'endDate',
						//'content' => '2004-01-21T20:00'
					]) ?>
				</li>
				<?= Html::tag('li', $value['content'], [
					'itemprop' => 'description'
				]) ?>

			</ul>

		</div>
	<?php } ?>
</div>





