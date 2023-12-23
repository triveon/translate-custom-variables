# Translate Custom Variables Magento 2

This is the official Translate Custom Variables Magento 2 extension. With this module it is possible to use custom variables in translatable strings in CMS elements.

## How does it work?

1. For example, you have a custom variable with code free_shipping_cost, and you want to place it in a translatable string in a CMS Block or CMS Page
2. To do this, the prefix "customVar_" must be placed before the custom variable code in the translation string
3. As: {{trans "Free Shipping from %free_shipping" free_shipping=customVar_free_shipping_cost}}

The %free_shipping will be replaced by the value from the custom variable free_shipping_cost.

## Installation

### Installation using composer (recommended)
To install the extension login to your environment using SSH. Then navigate to the Magento 2 root directory and run the following commands in the same order as described:

Enable maintenance mode:
~~~~shell
php bin/magento maintenance:enable
~~~~

1. Install the extension:
~~~~shell
composer require tig/postnl-magento2
~~~~

2. Enable the Translate Custom Variables Magento 2 plugin
~~~~shell
php bin/magento module:enable Triveon_TransCustomVars
~~~~

3. Update the Magento 2 environment:
~~~~shell
php bin/magento setup:upgrade
~~~~

When your Magento environment is running in production mode, you also need to run the following comands:

4. Compile DI:
~~~~shell
php bin/magento setup:di:compile
~~~~

5. Deploy static content:
~~~~shell
php bin/magento setup:static-content:deploy
~~~~

6. Disable maintenance mode:
~~~~shell
php bin/magento maintenance:disable
~~~~

### Installation manually
1. Download the extension directly from [github](https://github.com/triveon/translate-custom-variables) by clicking on *Code* and then *Download ZIP*.
2. Create the directory *app/code/Triveon/TransCustomVars* (Case-sensitive)
3. Extract the zip and upload the code into *app/code/Triveon/TransCustomVars*
4. Enable the Translate Custom Vars Magento 2 plugin
~~~~shell
php bin/magento module:enable Triveon_TransCustomVars
~~~~

5. Update the Magento 2 environment:
~~~~shell
php bin/magento setup:upgrade
~~~~

## Update
To update the Translate Custom Variables Extension run the following commands:
~~~~shell
composer update triveon/translate-custom-variables
php bin/magento setup:upgrade
~~~~
