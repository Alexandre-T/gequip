<?php
/**
 * This file is part of the Simdate Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Twig_Extension
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2016 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */
namespace AppBundle\Twig;

use Symfony\Component\Translation\Translator;

/**
 * Twig class extension to provide more dedicated filter.
 *
 * @category Twig
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class AppExtension extends \Twig_Extension
{
    /**
     * @var Translator
     */
    protected $translator;

    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * New filters declaration.
     *
     * @return array
     */
    public function getFilters()
    {
        $parent = parent::getFilters();
        return array_merge($parent, [
            new \Twig_SimpleFilter(
                'htmlMessage',
                [$this, 'htmlMessage'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFilter(
                'label',
                [$this, 'label'],
                ['is_safe' => ['html']]
            ),
        ]);
    }

    /**
     * To render introduction message, provide an html message.
     * Only non-dangerous tag will be preserved.
     *
     * @param $message
     *
     * @return string
     */
    public function htmlMessage($message)
    {
        $allowableTags = ['a', 'b', 'br', 'em', 'i', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'p', 'span', 'strong', 'ul'];
        return strip_tags($message, '<'.implode('><', $allowableTags).'>');
    }
    /**
     * To render label message.
     * Only non-dangerous message will be preserved.
     *
     * @param $message
     *
     * @return string
     */
    public function label($message)
    {
        if (true === $message) {
            $label = 'label-success';
            $content = $this->translator->trans('yes');
        } elseif (false === $message) {
            $label = 'label-danger';
            $content = $this->translator->trans('no');
        } elseif (empty($message)) {
            $label = 'label-default';
            $content = '<em>'.$this->translator->trans('unknown').'</em>';
        } else {
            $label = 'label-default';
            $content = $this->htmlMessage($message);
        }

        return "<span class=\"label $label\">$content</span>";
    }
    /**
     * Return name of extension.
     *
     * @return string
     */
    public function getName()
    {
        return 'app_extension';
    }
}
