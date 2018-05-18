<?php
namespace Concrete\Package\FormAdvancedCheckbox;

use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Attribute\TypeFactory;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Export\Item\AttributeType;
use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Facade;

class Controller extends Package
{
    protected $pkgHandle = 'form_advanced_checkbox';
    protected $appVersionRequired = '8.1';
    protected $pkgVersion = '0.0.1';

    public function getPackageName()
    {
        return t('Form advanced checkbox');
    }

    public function getPackageDescription()
    {
        return t('Form advanced checkbox');
    }
    public function install()
    {
        $pkg = parent::install();
        $this->takeOverBlockType($pkg);

    }

    public function uninstall()
    {
        $this->takeOverBlockType($this->pkg, true);
        parent::uninstall();

    }

    private function takeOverBlockType($pkg, $restore= false, $btHandle = 'form') {
        $db = Loader::db();
        if($restore){
            $db->query("update BlockTypes set pkgID = ? where btHandle = ?", array(0, $btHandle));
        }
        else {
            $db->query("update BlockTypes set pkgID = ? where btHandle = ?", array($pkg->getPackageID(), $btHandle));
        }
    }
}
