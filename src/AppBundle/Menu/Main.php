<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category Menu
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Menu Class.
 *
 * @category Menu
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */
class Main implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Main menu creation.
     *
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('menu.main.home', array(
            'icon' => 'home',
            'route' => 'homepage'
        ));

        // [New 3.0] Get our "authorization_checker" Object
        $auth_checker = $this->container->get('security.authorization_checker');

        if ($auth_checker->isGranted('ROLE_ADMIN')){
            $dropdownSettings = $menu->addChild('menu.main.settings', array(
                'icon' =>'cogs',
                'pull-right' => true,
                'dropdown' => true,
                'caret' => true,
            ));

            $dropdownSettings->addChild('menu.main.usefull-settings', array(
                'dropdown-header' => true
            ));

            $dropdownSettings->addChild('menu.main.families', array(
                'icon' => 'list',
                'route' => 'settings_families_list'
            ));

            //Adding a nice divider
            $dropdownSettings->addChild('divider_1', array('divider' => true))
                ->setExtra('translation_domain', false);

            $dropdownSettings->addChild('menu.main.all-settings', array(
                'icon' => 'cog',
                'route' => 'settings'
            ));
        }

        return $menu;
    }

    /**
     * User menu creation.
     *
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('user');

        // Alexandre : Mise en place de la sécurité
        // [New 3.0] Get our "authorization_checker" Object
        $auth_checker = $this->container->get('security.authorization_checker');
        # e.g: $auth_checker->isGranted('ROLE_ADMIN');

        // Get our Token (representing the currently logged in user)
        // [New 3.0] Get the `token_storage` object (instead of calling upon `security.context`)
        /* @var TokenInterface $token */
        $token = $this->container->get('security.token_storage')->getToken();

        # e.g: $token->getUser();
        # e.g: $token->isAuthenticated();
        # [Careful]            ^ "Anonymous users are technically authenticated"

        // Get our user from that token
        /* @var \AppBundle\Entity\Utilisateur $user */
        $user = $token->getUser();
        # e.g (w/ FOSUserBundle): $user->getEmail(); $user->isSuperAdmin(); $user->hasRole();

        // [New 3.0] Check for Roles on the $auth_checker
        $isFully = $auth_checker->isGranted('IS_AUTHENTICATED_FULLY');
        $isRemembered = $auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED');
        $isAnonymous = $auth_checker->isGranted('IS_AUTHENTICATED_ANONYMOUSLY');

        if ($isFully || $isRemembered) {
            $dropdownUser = $menu->addChild($user->getUsername(), array(
                'icon' =>'user',
                'pull-right' => true,
                'dropdown' => true,
                'caret' => true,
            ))->setExtra('translation_domain', false);
            $dropdownUser->addChild('menu.user.your-profile', array(
                'dropdown-header' => true
            ));
            $dropdownUser->addChild('menu.user.show-profile', array(
                'icon' => 'eye',
                'route' => 'fos_user_profile_show'
            ));
            $dropdownUser->addChild('menu.user.edit-profile', array(
                'icon' => 'pencil',
                'route' => 'fos_user_profile_edit'
            ));
            $dropdownUser->addChild('menu.user.change-password', array(
                'icon' => 'pencil',
                'route' => 'fos_user_change_password'
            ));
            //Adding a nice divider
            $dropdownUser->addChild('divider_1', array('divider' => true))
                ->setExtra('translation_domain', false);

            //Adding LOGOUT
            $dropdownUser->addChild('menu.user.logout', array(
                'icon' => 'sign-out',
                'route' => 'fos_user_security_logout'
            ));
        } elseif ($isAnonymous) {
            $menu->addChild('menu.user.sign-in', array(
                'icon' => 'sign-in',
                'route' => 'fos_user_security_login'
            ));
            $menu->addChild('menu.user.sign-up', array(
                'icon' => 'pencil-square-o',
                'route' => 'fos_user_registration_register'
            ));
        }

        return $menu;
    }

    /**
     * Footer menu creation.
     *
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function footerMenu(FactoryInterface $factory, array $options)
    {
        //Menu is empty
        $menu = $factory->createItem('footer');

        // Alexandre : Mise en place de la sécurité
        // [New 3.0] Get our "authorization_checker" Object
        $auth_checker = $this->container->get('security.authorization_checker');
        $isRoleSuperAdmin = $auth_checker->isGranted('ROLE_SUPER_ADMIN');
        $isFully = $auth_checker->isGranted('IS_AUTHENTICATED_FULLY');

        if ($isRoleSuperAdmin) {
            if ($isFully) {
            } else {
                //User is in a "remember me" situation. To access Admin, he must be fully authenticated
                $dropdownAdmin = $menu->addChild('menu.user.admin', array(
                    'icon' =>'cogs',
                    'pull-right' => true,
                    'dropdown' => true,
                    'caret' => true,
                ));
                $dropdownAdmin->addChild('menu.user.confirm-your-credentials', array(
                    'icon' => 'sign-up',
                    'route' => 'fos_user_security_login'
                ));
            }
        }
        return $menu;
    }
}
