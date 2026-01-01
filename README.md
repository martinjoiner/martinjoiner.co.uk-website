# martinjoiner.co.uk

## Martin Joiner's website

![martinjoiner.co.uk home page screenshot](/docs/screenshot.jpg)

[martinjoiner.co.uk](https://martinjoiner.co.uk) is a simple personal site with a homepage, CV and portfolio.

(Note: The `public_html/blog` folder is ignored because in production there is a WordPress blog installed in that folder)

Technology
----------

Static files compiled using [Eleventy](https://www.11ty.dev/), HTML5, CSS and vanilla JavaScript. Assets built-down using Grunt to concat, minify and version.

To serve locally...

```
npx @11ty/eleventy --serve
```

To check all the links work...

```
npm test
```