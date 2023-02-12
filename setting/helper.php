<?php

use Latte\Engine as Latte;
use Symfony\Component\HttpFoundation\Response;
use Takemo101\Egg\Kernel\Application;
use Takemo101\Egg\Support\StaticContainer;

if (!function_exists('latte')) {
    /**
     * Latteでテンプレートをレンダリングして文字列を返す
     *
     * @param string $path
     * @param object|mixed[] $params
     * @param string|null $block
     * @return string
     */
    function latte(string $path, object|array $params = [], ?string $block = null): string
    {
        /** @var Application */
        $app = StaticContainer::get('app');

        /** @var Latte */
        $latte = $app->container->make(Latte::class);

        return $latte->renderToString($path, $params, $block);
    }
}
