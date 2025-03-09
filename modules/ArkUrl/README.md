# Ark Url

Ark Url is a companion module for
[Ark](https://gitlab.com/Daniel-KM/Omeka-S-module-Ark) or
[Quark](https://github.com/biblibre/omeka-s-module-Quark)
that replace resources URLs by their ARK URL. So instead of `/s/site/item/1`
you will get `/s/site/ark:/99999/bapZs2`.

It replaces URLs for items, item sets and media. It doesn't change anything on the admin side.

Technically, it works by overloading the `siteUrl` method of
`ItemRepresentation`, `ItemSetRepresentation`, and `MediaRepresentation`
classes. So if a resource URL is built by another mean (for instance the url
view helper is called directly in a theme template), it won't work.
This is intentional to let the ability to use the original url if needed.
