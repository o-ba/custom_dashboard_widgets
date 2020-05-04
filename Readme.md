# TYPO3 Extension ``custom_dashboard_widgets``

## 1. Introduction

This extension adds a set of widgets for the new dashboard module, available since TYPO3 v10.3.

It however only works with TYPO3 v10.4 and higher as the widget registration was [reworked][1] in this release.

**Background**

This extensions evolves from [t3security_news_widget][2] which is outdated as it uses the old way to register widgets
and was however already implemented as a [core][3] widget with this [patch][4].

## 2. Installation

#### Installation with Composer

If you are using a composer based TYPO3 project just run `composer require o-ba/custom_dashboard_widgets`.

#### Installation from TER (TYPO3 Extension Repository)

You can download and install the extension in the extension manager module or download the ZIP file from [typo3.org][5]
and upload it in the extension manager module.

**First steps**

After the installation switch to the dashboard module.

If you have not set any dashboard yet, TYPO3 will create two dashboards automatically, which are defined in the presets.
The default dashboard, shipped by core and the custom dashboard including all custom widgets from this extension.

If you have already created some dashboards, simply create a new one by clicking the ``+`` button in the dashboard
select tab bar and select ``Custom dashboard.`` in the wizard. This will create the same dashboard mentioned before with
all widgets from this extension.

You can also add some custom widgets to already existing dashboards. This is explained in detail in the
[official documentation][6].

## 3. Further notice

This extension is intended as an example extension for
- adding custom widgets (including custom templates, custom stylesheets, ...)
- adding custom data providers,
- adding custom button providers,
- extending core API classes,
- adding custom widget groups,
- adding custom dashboard presets,
- adding TSconfig presets for backend users,
- and some more ...

You can find more information in the [official documentation][6].

#### Important
The included widgets and data providers **don't** evaluate any permissions! Therefore most of the widgets shouldn't be
activated for editors and only be used by admins.

### Included widgets
- ``extensionInformation``: Simple information widget with a custom template using an extended button provider
- ``failedSchedulerTasks``: Displays failed tasks and links to the module by using the extended button provider
- ``recentlyCreatedPages``: Displays a defined number of recently created pages with an edit link
- ``recentlyModifiedContent``: Displays a defined number of recently modified content with an edit link
- ``localExtensions``: Displays the amount of 3rd party extensions in the installation
- ``typeOfPages``: Doughnut chart showing amount of pages per page type
- ``typeOfContent``: Bar chart showing amount of contet elements per content type
- ``t3blog``: Listing of blog articles from [typo3.com][7]
- ``contribute``: Information widget with information on how to contribute

### Included DataProvider
- ``ExtendedButtonProvider``: Extends the default button provider for an icon and the possibility to link to modules
- ``FailedSchedulerTasksDataProvider``: A list data provider which fetches failed scheduler tasks
- ``ListOfRecordsDataProvider``: Provides a list of records by a given table, limit and order
- ``LocalExtensionsDataProvider``: Provides the number of local extensions present in the system
- ``RecordsByTypeDataProvider``: Provides chart data containing the amount of records for each record type

### Extended API classes
- ``WidgetApi``: Added a larger set of colors and a shuffle option

### Dependencies
Following widgets require additional TYPO3 packages which are suggested while installing this extension via composer.

- ``failedSchedulerTasks``: Requires ``typo3/cms-scheduler``
- ``localExtensions``: Requires ``typo3/cms-extensionmanager``

The mentioned widgets are configured through ``services.php`` instead of ``services.yaml`` to only make them available
if the required dependency is installed.

### Screenshots

![Custom Dashboard 1](Documentation/Images/Screenshot-1.png?raw=true "Custom Dashboard 1")
![Custom Dashboard 2](Documentation/Images/Screenshot-2.png?raw=true "Custom Dashboard 2")
![Custom Dashboard Selection](Documentation/Images/Screenshot-3.png?raw=true "Custom Dashboard Selection")

## 4. Credits

Icons used in this repository are made by [Freepik][8] from [www.flaticon.com][9]

[1]: https://review.typo3.org/c/Packages/TYPO3.CMS/+/63563
[2]: https://github.com/o-ba/t3security_news_widget
[3]: https://github.com/TYPO3/TYPO3.CMS
[4]: https://review.typo3.org/c/Packages/TYPO3.CMS/+/63397
[5]: https://extensions.typo3.org/extension/custom_dashboard_widgets
[6]: https://docs.typo3.org/c/typo3/cms-dashboard/master/en-us/
[7]: https://typo3.com/blog
[8]: https://www.flaticon.com/authors/freepik
[9]: http://www.flaticon.com
