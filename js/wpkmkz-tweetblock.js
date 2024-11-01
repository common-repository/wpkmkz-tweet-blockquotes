  jQuery(document).ready(function($) {
    $('blockquote.wpkmkz-tweetblock').each(function() {
      var quote = $(this);
      quote.append( '<a href="http://twitter.com/share?url='+quote.context.dataset.shorturl+'&text='+quote.context.outerText+' " class="wpkmkz-tweetblock-btn" data-lang="en" target="_blank">'+quote.context.dataset.text+'</a>' );
    });
  });