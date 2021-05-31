
// PRINT TICKET
function btnPrintTicket(){
    var printSec = document.getElementById("printTicketSection");
    $("#printTicketModal").modal('hide');
    printElement(printSec);
}

// REPRINT TICKET
function btnRePrintTicket(x){
    var id = x.getAttribute("data-id");
    var rePrintSec = document.getElementById("rePrintTicketSection" + id);
    $("#rePrintTicketModal" + id).modal('hide');
    printElement(rePrintSec);
}
    
function btnPrintReceipt(){
    var printSec = document.getElementById("printReceipt");
    $("#printReceiptModal").modal('hide');
    printElement(printSec);
}
  

// PRINT FUNCTION
function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}

window.onafterprint = function(){
    window.location.reload(true);
}