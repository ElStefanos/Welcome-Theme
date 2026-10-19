<?php
namespace WelcomeTheme;
use runtime\api\RuntimeRouterAPI;
use router\Router;
use object\ObjectFactory;
final class WelcomeThemeMain extends RuntimeRouterAPI
{
    public function environmentSetup(): void { parent::environmentSetup(); $this->waitForPackage('ThemeEngine'); }
    public function main(): void
    {
        $factory = (new ObjectFactory())->setClassName(\WelcomeTheme\controllers\AssetController::class)
            ->setType(\WelcomeTheme\controllers\AssetController::class)
            ->addMethodCall('setRootPath')->addMethodArgs('setRootPath',[$this->rootPath]);
        $this->addRouter((new Router('/welcome-theme/theme.css','css',$factory))->setName('welcome_theme.css'));
    }
}
