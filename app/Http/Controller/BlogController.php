<?php

namespace App\Http\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use CybozuHttp\Api\KintoneApi;
use Takemo101\Egg\Http\Exception\HttpException;
use Takemo101\Egg\Http\Filter\CsrfFilter;
use Throwable;

class BlogController
{
    /**
     * 一覧
     *
     * @param KintoneApi $api
     * @return string
     */
    public function index(KintoneApi $api)
    {
        $records = $api->records()->get(config('setting.blog-app-id', 1));

        return latte('blog/index.latte.html', $records);
    }

    /**
     * 詳細
     *
     * @param KintoneApi $api
     * @param integer $id
     * @return string
     */
    public function show(KintoneApi $api, CsrfFilter $filter, int $id)
    {
        $record = $api->record()->get(
            config('setting.blog-app-id', 1),
            $id,
        );

        return latte('blog/show.latte.html', [
            ...$record,
            'csrfToken' => $filter->token(),
        ]);
    }

    /**
     * 作成フォーム
     *
     * @param CsrfFilter $filter
     * @return Response
     */
    public function create(CsrfFilter $filter)
    {
        return latte('blog/create.latte.html', [
            'csrfToken' => $filter->token()
        ]);
    }

    /**
     * 作成処理
     *
     * @param KintoneApi $api
     * @param Request $request
     * @return string
     */
    public function store(KintoneApi $api, Request $request)
    {
        if ($request->get('pass') !== config('setting.blog-password', 'blog')) {
            throw new HttpException(
                statusCode: 500,
                message: 'パスワードが違います',
            );
        }

        try {
            $api->record()->post(
                config('setting.blog-app-id', 1),
                [
                    'タイトル' => [
                        'value' => $request->get('title')
                    ],
                    '内容' => [
                        'value' => $request->get('body')
                    ],
                ],
            );
        } catch (Throwable $e) {
            throw new HttpException(
                statusCode: 500,
                message: $e->getMessage(),
                previous: $e,
            );
        }

        return new RedirectResponse($request->headers->get('referer'));
    }

    /**
     * 削除
     *
     * @param KintoneApi $api
     * @param integer $id
     * @return string
     */
    public function remove(KintoneApi $api, int $id)
    {
        $record = $api->record()->delete(
            config('setting.blog-app-id', 1),
            $id,
        );

        return new RedirectResponse(route('index'));
    }
}
