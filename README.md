# martinjoiner.co.uk

![martinjoiner.co.uk home page screenshot](/docs/screenshot.jpg)

[martinjoiner.co.uk](https://martinjoiner.co.uk) is a simple personal site with a homepage, CV and portfolio.

(Note: The `public_html/blog` folder is ignored because in production there is a WordPress blog installed in that folder)

## Technology

Static HTML files compiled from source Nunjucks files using [Eleventy](https://www.11ty.dev/).

CSS and JavaScript assets built-down using Grunt to lint, concat, minify, version and inject.

To develop locally run these 2 tasks in separate terminals...

```bash
npx @11ty/eleventy --serve
```

```bash
grunt
```

To check all the links work...

```bash
npm test
```