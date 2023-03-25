(function($) {
    $(document).ready(function() {
  
      var wdAjaxUrl = reactionButtonData.ajax_url;
  
      /**
       * 
       */
      function ReactionButton( elem, posts ) {
        var self = this;
  
        self.elem             = elem;
        self.posts            = posts;
        self.id               = elem.data( 'postId' );
        self.reactions        = {};
        self.clickedReactions = [];
        
        // Check which reactions has been clicked
        $.each( posts, function( reaction, amount ) {
          self.reactions[ reaction ] = amount
          if ( Cookies.get( 'wd_reacted_' + reaction + '_' + self.id ) ) {
            self.clickedReactions.push( reaction );
          }
        });
  
        // Add clicked class
        self.elem.find( 'li' )
          .filter(function() {
            var reaction = $( this ).data( 'reaction' );
            return isClicked( reaction );
          })
          .addClass( 'clicked' );
  
        // Add reaction amounts
        self.elem.find( 'li' ).each( function() {
          var reaction = $( this ).data( 'reaction' );
          $( this ).find( 'span' ).text( self.reactions[ reaction ] );
        });
  
        /**
         * 
         */
        function isClicked( reaction ) {
          return self.clickedReactions.indexOf( reaction ) !== -1;
        }
  
        /**
         * 
         */
        function reactButton( event ) {
          event.preventDefault();
          
          var elem     = $( this );
          var unreact  = ( elem.hasClass("clicked") ? true : false );
          var reaction = elem.data().reaction;
          $.post(wdAjaxUrl, { postid: self.id, nonce: reactionButtonData.nonce, action: 'rb_reaction', reaction: reaction, unreact: unreact }, function(data) {

          var cookieKey = 'wd_reacted_' + reaction + '_' + self.id;

  
          if (unreact) {
            Cookies.remove(cookieKey);
          }
          else {
            Cookies.set( cookieKey, 'true', { expires: 30 } );
          }
  
          elem.toggleClass( "clicked" );
  
  
          var howMany = parseInt( elem.find('span').text() );
  
  
          if ( howMany > 0 ) {
            if (elem.hasClass( "clicked" ) ) {
              howMany += 1;
            } else {
              howMany -= 1;
            }
          } else {
            howMany = 1;
          }
          elem.find( 'span' ).text( howMany );

        });
  
        }

        self.elem.find( 'li' ).click( reactButton );
      }

      /**
       * 
       */
      function runPlugin() {
        var posts   = [];
        var postIds = [];

        $.get(wdAjaxUrl, { action: 'rb_html_icon' }, function( response ) {
  
          $('.reaction_button').each( function() {
            this.addEventListener("touchstart", function() {}, true);//not work
            $(this).html(response);
            postIds.push($(this).data('postId'));
            posts.push($(this));
          });
  
          $.post(wdAjaxUrl, {
              action: 'rb_get_reaction',
              posts: postIds
            },
  
            function(response) {
              $.each(posts, function(index, post) {
                var id = post.data('postId');
                new ReactionButton(post, response[id])
              });
            }
  
          );
        });
      }
  
      runPlugin();
  
    });
  
  })(jQuery);
  
  
  