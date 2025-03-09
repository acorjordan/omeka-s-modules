# OaiPmhRepositoryMediaPropertyMapper (Omeka S module)

This is a companion module for
[OaiPmhRepository](https://omeka.org/s/modules/OaiPmhRepository/). It allows to
expose media properties as if they were part of the item.

The complete documentation of OaiPmhRepositoryMediaPropertyMapper can be found
at https://biblibre.github.io/omeka-s-module-OaiPmhRepositoryMediaPropertyMapper

## Requirements

* Omeka S >= 3.2.0
* [OaiPmhRepository](https://omeka.org/s/modules/OaiPmhRepository/)

## Quick start

1. [Add the module to Omeka S](https://omeka.org/s/docs/user-manual/modules/#adding-modules-to-omeka-s)
2. In the module configuration page, add your mappings in the form
   `<media property> = <item property>` for instance
   `dcterms:title = dcterms:alternative` to expose media title as an
   alternative title.
   One mapping per line

## How to contribute

You can contribute to this module in many ways. Discover how by reading
[Contributing](CONTRIBUTING.md).

## Contributors / Sponsors

OaiPmhRepositoryMediaPropertyMapper was sponsored by:
* Campus Condorcet

## License

OaiPmhRepositoryMediaPropertyMapper is distributed under the GNU General Public
License, version 3 (GPLv3).
The full text of this license is given in the `LICENSE` file.
