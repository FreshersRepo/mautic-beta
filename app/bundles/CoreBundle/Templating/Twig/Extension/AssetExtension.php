<?php

namespace Mautic\CoreBundle\Templating\Twig\Extension;

use Mautic\CoreBundle\Templating\Helper\AssetsHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    /**
     * @var AssetsHelper
     */
    protected $assetsHelper;

    /**
     * AssetExtension constructor.
     */
    public function __construct(AssetsHelper $assetsHelper)
    {
        $this->assetsHelper = $assetsHelper;
    }

    /**
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return [
            'outputScripts'           => new TwigFunction('outputScripts', [$this, 'outputScripts'], ['is_safe' => ['all']]),
            'outputHeadDeclarations'  => new TwigFunction('outputHeadDeclarations', [$this, 'outputHeadDeclarations'], ['is_safe' => ['all']]),
            'getAssetUrl'             => new TwigFunction('getAssetUrl', [$this, 'getAssetUrl'], ['is_safe' => ['html']]),
            'outputStyles'            => new TwigFunction('outputStyles', [$this, 'outputStyles'], ['is_safe' => ['html']]),
            'outputSystemScripts'     => new TwigFunction('outputSystemScripts', [$this, 'outputSystemScripts'], ['is_safe' => ['html']]),
            'outputSystemStylesheets' => new TwigFunction('outputSystemStylesheets', [$this, 'outputSystemStylesheets'], ['is_safe' => ['html']]),
        ];
    }

    public function getName()
    {
        return 'coreasset';
    }

    public function outputSystemStylesheets()
    {
        ob_start();

        $this->assetsHelper->outputSystemStylesheets();

        return ob_get_clean();
    }

    /**
     * @param bool $includeEditor
     *
     * @return string
     */
    public function outputSystemScripts($includeEditor = false)
    {
        ob_start();

        $this->assetsHelper->outputSystemScripts($includeEditor);

        return ob_get_clean();
    }

    public function outputScripts($name)
    {
        ob_start();

        $this->assetsHelper->outputScripts($name);

        return ob_get_clean();
    }

    public function outputStyles()
    {
        ob_start();

        $this->assetsHelper->outputStyles();

        return ob_get_clean();
    }

    public function outputHeadDeclarations()
    {
        ob_start();

        $this->assetsHelper->outputHeadDeclarations();

        return ob_get_clean();
    }

    public function getAssetUrl($path, $packageName = null, $version = null, $absolute = false, $ignorePrefix = false)
    {
        return $this->assetsHelper->getUrl($path, $packageName, $version, $absolute, $ignorePrefix);
    }
}
