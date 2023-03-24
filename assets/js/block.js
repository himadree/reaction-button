(function () {

    const reactionButtonConfig = {
        title: 'Reaction Button',
        icon: 'smiley',
        category: 'common',
        edit() {
            return wp.element.createElement(
                'div',
                null,
                '[reaction-button]'
            );
        },
        save() {
            return (
                '[reaction-button]'
            );
        }
    };
    
    wp.blocks.registerBlockType( 'reaction-button-blocks/reaction-button', reactionButtonConfig );

})();