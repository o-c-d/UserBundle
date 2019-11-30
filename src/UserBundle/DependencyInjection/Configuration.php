<?php

namespace Ocd\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(OcdUserExtension::CONFIG_NAME);

        $rootNode
            ->children()
                ->scalarNode('user_class')
                    ->info('User entity class (FQDN)')
                    ->defaultValue('App\Entity\User')
                ->end()
                ->arrayNode('registration')
                    ->children()
                        ->booleanNode('public_registration')
                            ->info('Wether or not to allow everyone to create account')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('confirm_email')
                            ->info('Confirm Email before allowing users to log in')
                            ->defaultTrue()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('password')
                    ->children()
                        ->scalarNode('most_common_passwords_list')
                            ->info('List of most common password to check passwords against')
                            ->example('https://raw.githubusercontent.com/danielmiessler/SecLists/master/Passwords/richelieu-french-top20000.txt')
                            ->cannotBeEmpty()
                        ->end()
                        ->integerNode('min_length')
                            ->info('Password minimum characters length')
                            ->defaultValue(12)
                            ->min(8)->max(250)
                        ->end()
                        ->integerNode('max_length')
                            ->info('Password maximum characters length')
                            ->defaultValue(200)
                            ->min(64)->max(250)
                        ->end()
                        ->booleanNode('has_upper_lower_case')
                            ->info('Forces the password to contains Uppercase AND lowercase characters')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('has_letter_digit')
                            ->info('Forces the password to contains letters AND digits')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('has_special_character')
                            ->info('Forces the password to contains letters AND digits')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('path')
                    ->defaultValue('%kernel.project_dir%/var/OcdUser')
                ->end()
                ->scalarNode('password_token_ttl')
                    ->info('Password Reset Token TTL (seconds)')
                    ->defaultValue(7200)
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('email_from')
                    ->info('Sender emails')
                    ->example('John Doe <jdoe@domain.tld>')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
