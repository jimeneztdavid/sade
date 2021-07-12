$(document).ready(function() {
	// ejemplo de toast para cuando se registre un form o haya algun error
	// 
	 $.toast({
            heading: 'Welcome to Elite admin'
            , text: 'Use the predefined ones, or specify a custom position object.'
            , position: 'top-right'
            , loaderBg: '#ff6849'
            , icon: 'info'
            , hideAfter: 3500
            , stack: 6
        })
});