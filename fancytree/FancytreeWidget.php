<?php

/**
 * @link      https://github.com/wbraganca/yii2-fancytree-widget
 * @copyright Copyright (c) 2014 Wanderson Bragança
 * @license   https://github.com/wbraganca/yii2-fancytree-widget/blob/master/LICENSE
 */

namespace wbraganca\fancytree;

use yii\helpers\Html;
use yii\helpers\Json;

/**
 * The yii2-fancytree-widget is a Yii 2 wrapper for the fancytree.js
 * See more: https://github.com/mar10/fancytree
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class FancytreeWidget extends \yii\base\Widget {

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    private $extensions = [
        'childcounter' => 'src/jquery.fancytree.childcounter.js',
        'clones' => 'src/jquery.fancytree.clones.js',
        'columnview' => 'src/jquery.fancytree.columnview.js',
        'debug' => 'src/jquery.fancytree.debug.js',
        'dnd' => 'src/jquery.fancytree.dnd.js',
        'edit' => 'src/jquery.fancytree.edit.js',
        'filter' => 'src/jquery.fancytree.filter.js',
        'glyph' => 'src/jquery.fancytree.glyph.js',
        'gridnav' => 'src/jquery.fancytree.gridnav.js',
        'menu' => 'src/jquery.fancytree.menu.js',
        'persist' => 'src/jquery.fancytree.persist.js',
        'table' => 'src/jquery.fancytree.table.js',
        'themeroller' => 'src/jquery.fancytree.themeroller.js',
        'wide' => 'src/jquery.fancytree.wide.js'
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->registerAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets() {
        $view = $this->getView();
        $obj = FancytreeAsset::register($view);
        if (isset($this->options['extensions']) && is_array($this->options['extensions'])) {
            foreach ($this->options['extensions'] as $extension) {
                if (isset($this->extensions[$extension])) {
                    $obj->js[] = $this->extensions[$extension];
                }
            }
        }

        $id = 'fancyree_' . $this->id;
        if (isset($this->options['id'])) {
            $id = $this->options['id'];
            unset($this->options['id']);
        } else {
            echo Html::tag('div', '', ['id' => $id]);
        }
        $options = Json::encode($this->options);
        $view->registerJs('$("#' . $id . '").fancytree( ' . $options . ')');
    }

}
