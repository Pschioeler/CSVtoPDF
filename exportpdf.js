//Exported PDF is made to use the browser print
//it is not the best or prettiest way to do it
//alternatively it could be made with pdfmaker, jspdf etc.

function downloadPDFWithBrowserPrint() {
    window.print();
  }
  document.querySelector('#browserPrint').addEventListener('click', downloadPDFWithBrowserPrint);