<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $indent integer */
/* @var $pageTree app\modules\page\models\Page */
?>
<?= false//'<pre>'.var_export($pageTree,1).'</pre>';?>
<?php $indent = isset($indent) ? $indent : 0; ?>
<?php if (!empty($pageTree)): ?>
    <?php foreach ($pageTree as $page): ?>
        <li>
            <div class="tree-item">
                <?php for ($i = 0; $i < $indent; $i++): ?>
                    <span class="indent"></span>
                <?php endfor; ?>
                <?php if (!empty($page['children'])): ?>
                    <a href="#collapse<?= $page['id']; ?>" class="chevron" data-toggle="collapse">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="indent"></span>
                <?php endif; ?>
                <span class="tree-title"><?= $page['name']; ?></span>
                <span class="tree-label"><?= $page['title']; ?></span>
                <span class="tree-badge">
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $page['id']]) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $page['id']], [
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </span>
            </div>
            <ul id="collapse<?= $page['id']; ?>" class="tree-view collapse">
                <?php if (!empty($page['children'])): ?>
                    <?= $this->render('_tree', [
                        'pageTree' => $page['children'],
                        'indent' => $indent + 1,
                    ]) ?>
                <?php endif; ?>
            </ul>
        </li>
    <?php endforeach; ?>
<?php endif; ?>