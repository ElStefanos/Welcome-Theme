<?php
namespace WelcomeTheme\controllers;
final class AssetController extends \controller\Controller
{
    public function index(array|string $params = []): \response\Response { return $this->css($params); }
    public function css(array|string $params = []): \response\Response
    {
        return \response\Response::make()->file($this->rootDirPath.'/assets/theme.css')->asCss();
    }
}
