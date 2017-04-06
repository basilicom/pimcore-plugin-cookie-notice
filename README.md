CheckHealth Pimcore Plugin
================================================
    
Developer info: [Pimcore at basilicom](http://basilicom.de/en/pimcore)

## Synopsis

This Pimcore http://www.pimcore.org plugin provides a controller/action
where upon access a couple of checks regarding system health are performed.
Output is SUCCESS or FAILURE - this is suitable for continuous monitoring
via StatusCake, Pingdom or a similar service.

## Code Example / Method of Operation

After installing the plugin, configuration options are exposed via the 
configure button in the Extension Manager.

## Installation

Add "basilicom-pimcore/cookie-notice" as a requirement to the composer.json 
in the toplevel directory of your Pimcore installation. Then enable and install 
the plugin in Pimcore Extension Manager (under Extras > Extensions)

Example:

    {
        "require": {
            "basilicom-pimcore-plugin/protected-admin": ">=1.0.0"
        }
    }

## Contributors

* Marcel Eichhorn marcel.eichhorn@basilicom.de
* Marco Senkpiel marco.senkpiel@basilicom.de

## License

* GNU General Public License version 3 (GPLv3)

