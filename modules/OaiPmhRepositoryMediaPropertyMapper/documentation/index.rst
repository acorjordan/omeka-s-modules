Introduction
============

OaiPmhRepository Media Property Mapper is a companion module for
`OaiPmhRepository <https://omeka.org/s/modules/OaiPmhRepository/>`_.
It allows to expose media properties as if they were part of the item.

How does it work ?
------------------

It uses the ``oaipmhrepository.values.pre`` event to add values to the set of
values that will then be processed by OaiPmhRepository module. It means that:

* Values can only be added. They do not replace existing values
* Depending on the metadata format used (oai_dc, mets, ...), only a subset of
  these values will actually be exposed. For instance, ``oai_dc`` exposes only
  ``dcterms`` properties.

Configuration
-------------

Configuration can be found in the module configuration page.

More details on the :doc:`configuration` page.

.. toctree::
   :maxdepth: 2
   :hidden:

   configuration
