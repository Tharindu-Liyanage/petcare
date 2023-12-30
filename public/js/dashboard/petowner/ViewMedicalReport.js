document.getElementById('downloadPdf').addEventListener('click', function () {
    // Select the element that you want to convert to PDF
    const element = document.querySelector('.is-visible .report');

     // Specify the filename for the downloaded PDF
   
    // Call the html2pdf library to generate PDF with the specified filename
    html2pdf(element, { filename: filename });
});

const splide = new Splide( '.splide' );

splide.on( 'pagination:mounted', function ( data ) {

// `items` contains all dot items
data.items.forEach( function ( item ) {
item.button.textContent = String( item.page + 1 );
} );
} );



splide.mount();