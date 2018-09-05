<?php

use yii\helpers\Html;

$model->salary = $model->salary ?: 0;

$this->title = $model->position->text;

if ($model->status_id == $model::STATUS_EXPIRED)
	$this->title .= ' (Вакансия в архиве)';

\Yii::$app->params['description'] = "Вакансия ({$model['created']}). {$model->region->text}, {$model->city->text}. Оклад: {$model->salary} ₽. Требуемый опыт: {$model->experience->text}. {$model->employment->text}.";

?>

<div itemscope itemtype="http://schema.org/JobPosting">

	<?= Html::tag('h2', $model->position->text, [
		'itemprop' => 'title'
	]) ?>

	<?= Html::tag('div', $model->content, [
		'itemprop' => 'description'
	]) ?>

	<ul itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
		<li>
			Компания:
			<?= Html::tag('span', $model->company_place->text ?: $model->user->company->title->text, [
				'itemprop' => 'name'
			]) ?>
		</li>
		<li>
			Контактный телефон:
			<?= Html::tag('span', "+7{$model->phone}", [
				'itemprop' => 'telephone'
			]) ?>
		</li>
		<li>
			Адрес:
			<?= Html::tag('span', "{$model->region->text}, {$model->city->text}", [
				'itemprop' => 'address'
			]) ?>
		</li>
	</ul>

	<ul itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
		<li itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			Местонахождения:
			<?= Html::a($model->region->text, ['vacancy/index', 'region' => $model->region->id], [
				'itemprop' => 'addressRegion',
				'title' => "Работа в {$model->region->text}"
			]) ?> &rarr; 
			<?= Html::a($model->city->text, ['vacancy/index', 'region' => $model->region->id, 'city' => $model->city->id], [
				'itemprop' => 'addressLocality',
				'title' => "Вакансии в городе {$model->city->text}"
			]) ?>
			<span itemprop="streetAddress"></span>
			<span itemprop="postalCode"></span>
		</li>
		<li>
			Контактный телефон:
			<?= Html::tag('span', "+7{$model->phone}", [
				'itemprop' => 'telephone'
			]) ?>
		</li>
		<li>
			Название компании:
			<?= Html::tag('span', $model->company_place->text ?: $model->user->company->title->text, [
				'itemprop' => 'name'
			]) ?>
		</li>
	</ul>

	<ul>
		<li>
			Категория: 
			<?= Html::a($model->scope->text, ['vacancy/index', 'scope' => $model->scope->id], [
				'itemprop' => 'industry'
			]) ?>
		</li>
		<li>
			Зарплата (<?= Html::tag('span', 'RUB', ['itemprop' => 'salaryCurrency']) ?>):
			<?= Html::tag('span', $model->salary, [
				'itemprop' => 'baseSalary'
			]) ?>
		</li>
		<li>
			Опубликована:
			<?= Html::tag('span', Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d'), [
				'itemprop' => 'datePosted'
			]) ?>
		</li>
		<li>
			Опыт работы:
			<?= Html::tag('span', $model->experience->text, [
				'itemprop' => 'experienceRequirements'
			]) ?>
		</li>
		<li>
			Тип занятости:
			<?= Html::tag('span', $model->employment->text, [
				'itemprop' => 'employmentType'
			]) ?>
		</li>
	</ul>

</div>