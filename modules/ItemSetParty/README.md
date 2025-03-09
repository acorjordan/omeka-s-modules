# Item Set Party

This module allows you to view a hierarchy of resources based on the item sets defined in its parameters.
Resources are linked using the dcterms:hasPart property.

The complete documentation of ItemSetParty can be found [here](https://biblibre.github.io/omeka-s-module-ItemSetParty).

## Rationale

This plugin offers a new visualization of Omeka S resources:
- archival visualization similar to the EAD tree structure, which combines
  several types of resources (item sets, items and media) in a single
  hierarchy, enabling the visualization of the different levels
- visualization of periodicals organized in parent-child records

## Requirements

* Omeka S >= 3.0.0

## Quick start

1. [Add the module to Omeka S](https://omeka.org/s/docs/user-manual/modules/#adding-modules-to-omeka-s)
2. Login to the admin interface, define item sets to be used on module configuration page.
3. Use the module

## Features

This module creates a resource hierarchy based on one or more item sets defined in its configuration.

On the admin side, you’ll see a dynamic display, i.e. linked resources will appear when clicked on non-grayed resources (i.e. with ‘hasPart’ relationships).

The special feature on the admin side is the ability to load a sidebar with resource data.

On the site side, there are two possibilities:

- the first is a display through the navigation, rendered as the dynamic equivalent of the admin view.
- the other, via the block, is a static rendering with a predefined depth.

## Comparison with similar modules

[ItemSetsTree](https://github.com/biblibre/omeka-s-module-ItemSetsTree) is another module to view an item sets hierarchy based on configured parent item set.


## How to contribute

You can contribute to this module by adding issues directly [here](https://github.com/biblibre/omeka-s-module-ItemSetParty/issues).

## Contributors / Sponsors

Contributors:
* [ThibaudGLT](https://github.com/ThibaudGLT)

ItemSetParty was sponsored by:
* [Sciences Po Paris](https://www.sciencespo.fr)

## Licence

ItemSetParty is distributed under the GNU General Public License, version 3. The full text of this license is given in the LICENSE file.

Created by [BibLibre](https://www.biblibre.com).
