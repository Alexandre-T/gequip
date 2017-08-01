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

        $menu->addChild('Home', array(
            'icon' => 'home',
            'route' => 'homepage'
        ));

        $dropdownSettings = $menu->addChild('Settings', array(
            'icon' =>'cogs',
            'pull-right' => true,
            'dropdown' => true,
            'caret' => true,
        ));

        $dropdownSettings->addChild('Useful settings', array(
            'dropdown-header' => true
        ));

        $dropdownSettings->addChild('Families', array(
            'icon' => 'list',
            'route' => 'settings_families_list'
        ));

        //Adding a nice divider
        $dropdownSettings->addChild('divider_1', array('divider' => true));

        $dropdownSettings->addChild('All settings', array(
            'icon' => 'cog',
            'route' => 'settings'
        ));

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
        dump($token);

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
            ));
            $dropdownUser->addChild('Your profile', array(
                'dropdown-header' => true
            ));
            $dropdownUser->addChild('Show profile', array(
                'icon' => 'eye',
                'route' => 'fos_user_profile_show'
            ));
            $dropdownUser->addChild('Edit profile', array(
                'icon' => 'pencil',
                'route' => 'fos_user_profile_edit'
            ));
            $dropdownUser->addChild('Change password', array(
                'icon' => 'pencil',
                'route' => 'fos_user_change_password'
            ));
            //Adding a nice divider
            $dropdownUser->addChild('divider_1', array('divider' => true));

            //Adding LOGOUT
            $dropdownUser->addChild('Logout', array(
                'icon' => 'sign-out',
                'route' => 'fos_user_security_logout'
            ));
        } elseif ($isAnonymous) {
            $menu->addChild('Sign In', array(
                'icon' => 'sign-in',
                'route' => 'fos_user_security_login'
            ));
            $menu->addChild('Sign Up', array(
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
        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        $isFully = $auth_checker->isGranted('IS_AUTHENTICATED_FULLY');

        if ($isRoleAdmin) {
            if ($isFully) {
            } else {
                //User is in a "remember me" situation. To access Admin, he must be fully authenticated
                $dropdownAdmin = $menu->addChild('Admin', array(
                    'icon' =>'cogs',
                    'pull-right' => true,
                    'dropdown' => true,
                    'caret' => true,
                ));
                $dropdownAdmin->addChild('Confirm your connexion', array(
                    'icon' => 'sign-up',
                    'route' => 'fos_user_security_login'
                ));
            }
        }
        return $menu;
    }
}
