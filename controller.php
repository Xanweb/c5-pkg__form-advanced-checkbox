<?php
namespace Concrete\Package\CookiesDisclaimer;

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Package\Package;

defined('C5_EXECUTE') or die('Access Denied.');

class Controller extends Package
{
    protected $pkgHandle = 'cookies_disclaimer';
    protected $appVersionRequired = '8.1';
    protected $pkgVersion = '1.0.1';

    public function getPackageName()
    {
        return t('Cookies disclaimer');
    }

    public function getPackageDescription()
    {
        return t('Cookies disclaimer');
    }

    public function install()
    {
        $pkg = parent::install();

        //Addijng single page with title, content button title
    }
}
