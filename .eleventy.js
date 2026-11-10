
import { minify } from 'html-minifier';

export default function(eleventyConfig) {

  eleventyConfig.addWatchTarget("./src/");

  eleventyConfig.addTransform("htmlmin", async function(content, outputPath) {
    // Eleventy 1.0+: use this.inputPath and this.outputPath instead
    if( outputPath.endsWith(".html") ) {
      return await minify(content, {
        collapseWhitespace: true,
        removeAttributeQuotes: false,
        removeComments: true,
        removeOptionalTags: false,
        useShortDoctype: true,
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

  eleventyConfig.setInputDirectory("src");
  eleventyConfig.setOutputDirectory("public_html");

};
