
const htmlmin = require("html-minifier");

module.exports = function(eleventyConfig) {

  eleventyConfig.addWatchTarget("./src/");

  eleventyConfig.addTransform("htmlmin", function(content, outputPath) {
    // Eleventy 1.0+: use this.inputPath and this.outputPath instead
    if( outputPath.endsWith(".html") ) {
      return htmlmin.minify(content, {
        useShortDoctype: true,
        removeComments: true,
        collapseWhitespace: true
      });
    }

    return content;
  });

  eleventyConfig.addShortcode("tag", function (tag) {

    if (typeof tag === 'string') {
      // Convert into an object as if it were provided as named arguments
      tag = { tech: tag }
    }

    if (tag.tag === undefined) {
      tag.tag = tag.tech.toLowerCase().replace(/\W+/, '')
    }

    return '<span class="tag tag-' + tag.tag + '" data-tag="tag-' + tag.tag + '">' + tag.tech + '</span>'
  });

  return {
    dir: {
      input: "src",
      output: "public_html"
    }
  }

};

