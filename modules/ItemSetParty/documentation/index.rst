Introduction
============

How does it work ?
------------------

This module allows you to view a hierarchy of resources based on the item sets defined in its parameters. 
Resources are linked using the dcterms:hasPart property.

No dependencies needed.

Where is the configuration
--------------------------

Module can be configured in the following locations:

- configure button on the modules page (Admin > Modules > ItemSetParty > Configure button)
- separate page accessible from the navigation menu (Admin > Sites > Edit 'YourSite' > Navigation section > Add custom link 'Item Set Party')
- block page settings (Admin > Sites > Edit 'YourSite' > Pages > Edit 'YourPage' > Add new block 'Item Set Party')

More details on the :doc:`configuration` page.

Similar modules
---------------

ItemSetsTree_ is another module to view an item sets hierarchy based on configured parent item set.

.. _ItemSetsTree: https://github.com/biblibre/omeka-s-module-ItemSetsTree

.. toctree::
   :maxdepth: 2
   :caption: Contents

   configuration
   features
   interface-with-other-modules
