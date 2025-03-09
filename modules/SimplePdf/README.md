# Simple PDF: Omeka S module

This module embeds a simple document viewer for PDF files. Compatible with major browsers and accessibility software.

## Installation

Use the zipped releases provided on GitHub for a standard install.

You may also clone the git repository, rename the folder to `SimplePdf`, and build from source with:

```
npm install
gulp
```

## Interoperability

For users of Omeka S 4.0 and higher, we recommend making use of the "smart embeds" resource page block included in the [PageBlocks](https://github.com/ivyrze/omeka-s-module-pageblocks) module.

In order to use this module in conjunction with [AmazonS3](https://github.com/Daniel-KM/Omeka-S-module-AmazonS3), you must [setup a CORS policy](https://docs.aws.amazon.com/AmazonS3/latest/userguide/enabling-cors-examples.html) on your buckets.

## License

This module uses a GPLv3 license. It relies on [Mozilla's pdf.js](https://github.com/mozilla/pdf.js), which is released under an Apache license.