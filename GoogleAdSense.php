<?php
/**
 * @copyright Copyright (C) Simon Smith
 * @copyright Copyright (C) 2015 AIZAWA Hina
 * @license https://github.com/fetus-hina/yii2-googleadsense/blob/master/LICENSE MIT
 * @author Simon Smith
 * @author AIZAWA Hina <hina@bouhime.com>
 */

namespace jp3cki\yii2\googleadsense;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

class GoogleAdSense extends Widget
{
    /**
     * @var string $slot the ID of the ad slot.
     */
    public $slot;

    public $client;

    public $enable = true;

    /**
     * @var string $style optional style information; default is "display:block."
     */
    public $style = 'display:block';

    /**
     * @var boolean $responsive optional value specifying whether the ad unit is responsive; defaults to false.
     */
    public $responsive = false;

    /**
     * Generates the ad.
     */
    public function run()
    {
        // Return an ad if showing ads is enabled, or a placeholder if it's not.
        if ($this->enable) {
            $adCode = [
                'class' => 'adsbygoogle',
                'style' => $this->style,
                'data-ad-client' => $this->client,
                'data-ad-slot' => $this->slot,
            ];
            if ($this->responsive) {
                $adCode['data-ad-format'] = 'auto';
            }
            echo Html::tag('ins', '', $adCode);

            $view = $this->view;
            $view->registerJsFile(
                '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
                [
                    'position' => View::POS_END,
                    'async' => 'async',
                ]
            );
            $view->registerJs(
                '(adsbygoogle = window.adsbygoogle || []).push({})',
                View::POS_END
            );
        } else {
            echo Html::tag('div', 'Advertisement goes here', [
                    'style' => 'background:#eee;' . $this->style,
                ]);
        }
    }
}
