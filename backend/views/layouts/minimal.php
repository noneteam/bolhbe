<?php

use yii\helpers\Html;

\backend\assets\AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody() ?>
			<div class="container">
				<?= $content ?>
			</div>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>