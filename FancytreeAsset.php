<?php
/**
 * @link      https://github.com/wbraganca/yii2-fancytree-widget
 * @copyright Copyright (c) 2014 Wanderson Bragança
 * @license   https://github.com/wbraganca/yii2-fancytree-widget/blob/master/LICENSE
 */

namespace wbraganca\fancytree;

/**
 * Asset bundle for fancytree Widget
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class FancytreeAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/fancytree';
    public $skin = 'dist/skin-lion/ui.fancytree';

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset'
    ];

    /**
     * Set up CSS and JS asset arrays based on the base-file names
     * @param string $type whether 'css' or 'js'
     * @param array $files the list of 'css' or 'js' basefile names
     */
    protected function setupAssets($type, $files = [])
    {
        $srcFiles = [];
        $minFiles = [];
        foreach ($files as $file) {
            $srcFiles[] = "{$file}.{$type}";
            $minFiles[] = "{$file}.min.{$type}";
        }
        if (empty($this->$type)) {
            $this->$type = YII_DEBUG ? $srcFiles : $minFiles;
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setupAssets('css', [$this->skin]);
        $this->setupAssets('js', ['dist/jquery.fancytree-all']);
        parent::init();
    }

}
