# TYPO3 Extension ``custom_dashboard_widgets``

## 1. Introduction

This extension adds a set of widgets for the new dashboard module, available since TYPO3 10.3.
This however only works with TYPO3 v10.4 and higher as the widget registration was reworked in this release.

**Background**

This extensions evolves from [t3security_news_widget][1] which is outdated as it uses the old way to register widgets
and was however already implemented as a [core][2] widget with this [patch][3].

## 2. Installation

#### Installation with Composer

If you are using a composer based TYPO3 project just run `composer require o-ba/custom_dashboard_widgets`.

#### Installation from TER (TYPO3 Extension Repository)

You can download and install the extension in the extension manager module or download the ZIP file from [typo3.org][4]
and upload it in the extension manager module.

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

You can find more information in the [official documentation][5].

⚠️ **Important*️* ⚠️
The included widgets and data providers **don't** evaluate any permissions! Therefore the widgets and data providers
shouldn't be activated for editors and only be used by admins.

### Included widgets
- ``extensionInformation``: Simple information widget with a custom template using an extended button provider
- ``failedSchedulerTasks``: Displays failed tasks and links to the module by using the extended button provider
- ``recentlyCreatedPages``: Displays a defined number of recently created pages with edit link
- ``recentlyModifiedContent``: Displays a defined number of recently modified content with edit link
- ``localExtensions``: Displays the amount of 3rd party extensions in the installation
- ``typeOfPages``: Doughnut chart showing amount of pages per page type
- ``typeOfContent``: Bar chart showing amount of contet elements per content type
- ``t3blog``: Listing of blog articles from [typo3.com][6]
- ``contribute``: Information widget with information on how to contribute

### Included DataProvider
- ``ExtendedButtonProvider``: Extends the default button provider for an icon and the possibility to link to modules
- ``FailedSchedulerTasksDataProvider``: A list data provider which fetches failed scheduler tasks
- ``ListOfRecordsDataProvider``: Provides a list of records by a given table, limit and order
- ``LocalExtensionsDataProvider``: Provides the number of local extensions present in the system
- ``RecordsByTypeDataProvider``: Provides chart data containing the amount of records for each record type

### Extended API classes
- ``WidgetApi``: Added a larger set of colors and a shuffle option

### Screenshots

![Custom Dashboard 1](Documentation/Images/Screenshot-1.png?raw=true "Custom Dashboard 1")
![Custom Dashboard 2](Documentation/Images/Screenshot-2.png?raw=true "Custom Dashboard 2")
![Custom Dashboard Selection](Documentation/Images/Screenshot-3.png?raw=true "Custom Dashboard Selection")

## 4. Credits

Icons used in this repository are made by [Freepik][7] from [www.flaticon.com][8]

[1]: https://github.com/o-ba/t3security_news_widget
[2]: https://github.com/TYPO3/TYPO3.CMS
[3]: https://review.typo3.org/c/Packages/TYPO3.CMS/+/63397
[4]: https://extensions.typo3.org/extension/custom_dashboard_widgets
[5]: https://docs.typo3.org/c/typo3/cms-dashboard/master/en-us/
[6]: https://typo3.com/blog
[7]: https://www.flaticon.com/authors/freepik
[8]: http://www.flaticon.com
