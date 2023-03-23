;( function( $ ) {
    $(document).ready(function() {
  
      const{log} = console;
  
      var wdAjaxUrl = reactionButtonData.ajax_url;
  
      /**
       * 
       */
      function runPlugin() {
        var posts = [];
        var postIds = [];
        $.get(wdAjaxUrl, {action: 'rb_html_icon'}, function(response) {
  
        //   log(response);
  
          $('.reaction_button').each(function() {
            $(this).html(response);
            postIds.push($(this).data('postId'));
            posts.push($(this));
          });
          
        });
      }
  
      runPlugin();
  
    });
  
  })(jQuery);
  
  
  