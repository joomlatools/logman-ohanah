# LOGman Ohanah Plugin

Plugin for integrating [Ohanah](https://www.joomlatools.com/extensions/ohanah/) with [LOGman](https://www.joomlatools.com/extensions/logman/). LOGman is a user analytics and audit trail solution for Joomla.

## Requirements

- LOGman 4.0 or newer
- Ohanah Events

## Installation

Install using [Composer](https://getcomposer.org/). Go to the root directory of your Joomla installation in command line and execute this command:

```
composer require joomlatools/plg_logman_ohanah:dev-master
```

After installation, enable the plugin in the Joomla Plugin Manager and ensure both LOGman and Ohanah are installed.

## Supported Activities

The following Ohanah actions are logged:

### Events

* Add
* Edit
* Delete
* Publish/Unpublish

### Categories

* Add
* Edit
* Delete

### Tickets/Attendees

* Add
* Edit
* Delete

## License

LOGman Ohanah Plugin is open-source software licensed under the [GPLv3 license](LICENSE.txt).
