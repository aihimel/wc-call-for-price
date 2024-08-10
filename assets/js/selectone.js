(function ( $ ) {
    /**
     * jQuery plugin to select only one checkbox of the selected class elements
     *
     * @since WCP_SINCE
     */
    $.fn.selectOne = function () {
        let list = this;
        this.on( 'change', function ( e ) {
            $.each( list, ( index, item ) => {
                if ( e.target !== item ) {
                    $(item).prop( 'checked', false );
                }
            } )
        } )
    }
})(jQuery)