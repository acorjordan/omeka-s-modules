# ID Resolver

An [Omeka S](https://omeka.org/s/) module that that resolves legacy IDs to Omeka
S resources via an endpoint.

This is useful for projects that migrated from a legacy system to Omeka S and need
a way to redirect from legacy resource URLs to their new resource URLs in Omeka
S. This will require a separate script that listens for incoming legacy requests
and makes a request against the endpoint provided by this module. The endpoint
will automatically redirect the client to the new resource URL.

### Endpoint

The endpoint is under the site route, so a script may make a request against any
Omeka S site, depending on where the migrated resources exist.

```
/s/:site-slug/id-resolver
```

The endpoint accepts the following query parameters (all are required):

- `id`: The legacy ID
- `resource`: The Omeka S resource name ("item", "item_set", or "media")
- `property`: The Omeka S property ID or term (e.g. `dcterms:identifier`)

If more than one Omeka S resource has the ID with the provided property, the endpoint
redirects the client to the browse page containing each resource.

# Copyright

ID Resolver is Copyright © 2021-present Corporation for Digital Scholarship,
Vienna, Virginia, USA http://digitalscholar.org

The Corporation for Digital Scholarship distributes the Omeka source code under
the GNU General Public License, version 3 (GPLv3). The full text of this license
is given in the license file.

The Omeka name is a registered trademark of the Corporation for Digital Scholarship.

Third-party copyright in this distribution is noted where applicable.

All rights not expressly granted are reserved.
