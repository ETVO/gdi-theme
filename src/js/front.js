/** 
 * Front-end scripts
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

 (jQuery)(
    function($) {

        function generateBlogFeed() {
            // Don't size if it has been disabled
            if($(this).attr("data-sized") == "false")
                return;

            $(".blog_feed").each(function(index, elem) {
                sizeUpperPart(elem, 0);
            });
        }   

        a = 0;

        function sizeUpperPart(elem, biggest) { 
            // Define recursive operational boolean
            discover = false;
            if(biggest == 0) discover = true;

            a++;
            if(a == 99) return;

            var $items = $(elem).find(".item");
            
            for (var i = 0; i < $items.length; i++) {
                
                // Get item
                var item = $items[i];
                var upperPart = $(item).find('.upper-part')[0];

                if(discover) {
                    if(upperPart.clientHeight > biggest) {
                        biggest = upperPart.clientHeight;
                    }
                }
                else {
                    upperPart.style = 'min-height: ' + biggest + 'px;';
                }
            }

            if(discover) sizeUpperPart(elem, biggest);
        }

        /**
         * Generate clickable custom links
         * 
         * @since 2.0
         */
        function generateClickableCustomLinks() {
            $(".clink").each(function() {
                var href = $(this).attr("href");
                if(href != '') {
                    $(this).css('cursor', 'pointer');

                    $(this).on('click', () => {
                        if($(this).attr("target") == '_blank') 
                            window.open(href);
                        else
                            window.location.href = href;
                        return;
                    });
                }
            });
        }

        function generateFormMultiple() {
            $(".form_multiple").each(function() {

                var options = this;

                changeDepartamentos(options);
            
                $(this).find('.nav-link').on('click', function() {
                    changeDepartamentos(options);
                });
                
            });
        }

        function changeDepartamentos(options) {
            var input = $(options).find('input[name="departamentos"]').get(0);
            var form = $(options).find('form').get(0);

            var navActive = $(options).find('.nav-link.active').get(0);

            value = navActive.innerHTML.trim(); 
            if(value == '')
                value = 'Geral';
            input.value = value;
        }

        /**
         * Invoke functions when document.body is ready 
         */
        $(document.body).ready(function (){
            generateBlogFeed();
            generateClickableCustomLinks();
            generateFormMultiple();
        });
    }
)