
let services = 1;
let servicesJSON = [];
let subTotal;
let taxPrice;
let totalPrice;

document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("invoice_create").addEventListener("click", () => {
        const invoiceNumber = document.getElementById("invoiceNumber").value;
        const customerName = document.getElementById("customerName").value;
        const customerAddress = document.getElementById("customerAddress").value;
        const customerInfos = document.getElementById("customerInfos").value;
        const payUntil = document.getElementById("payUntil").value;
        const tax = document.getElementById("tax").value;

        servicesToJSONDescription();

        taxPrice = parseFloat(subTotal / 100 * tax);
        totalPrice = parseFloat(subTotal + taxPrice);

        createInvoiceJSON(invoiceNumber, customerName,
            customerAddress, customerInfos, payUntil, tax, servicesJSON,
            subTotal, taxPrice, totalPrice
        );

        servicesJSON = [];

    })

    document.getElementById("addService").addEventListener("click", () => {
        const serviceTable = document.getElementById("serviceTable");

        const tr = document.createElement("tr");
        tr.id = `services-${services}`;

        const serviceDescriptionTD = document.createElement("td");
        const serviceDescriptionInput = document.createElement("input");
        serviceDescriptionInput.id = "serviceDescription-" + services;
        serviceDescriptionInput.classList.add("serviceDescription");
        serviceDescriptionTD.appendChild(serviceDescriptionInput);

        tr.appendChild(serviceDescriptionTD);


        const servicePriceTD = document.createElement("td");
        const servicePriceInput = document.createElement("input");
        servicePriceInput.id = "servicePrice-" + services;
        servicePriceInput.classList.add("servicePrice");
        servicePriceTD.appendChild(servicePriceInput);

        tr.appendChild(servicePriceTD);


        const serviceQuantityTD = document.createElement("td");
        const serviceQuantityInput = document.createElement("input");
        serviceQuantityInput.id = "serviceQuantity-" + services;
        serviceQuantityInput.classList.add("serviceQuantity");
        serviceQuantityTD.appendChild(serviceQuantityInput);

        tr.appendChild(serviceQuantityTD);


        const serviceUnitTD = document.createElement("td");
        const serviceUnitInput = document.createElement("input");
        serviceUnitInput.id = "serviceUnit-" + services;
        serviceUnitInput.classList.add("serviceUnit");
        serviceUnitTD.appendChild(serviceUnitInput);

        tr.appendChild(serviceUnitTD);


        const serviceDeleteButton = document.createElement("button");
        serviceDeleteButton.innerText = "-";
        serviceDeleteButton.value = services;
        serviceDeleteButton.className = "serviceDeleteButton";
        serviceDeleteButton.id = "serviceDeleteButton";

        tr.appendChild(serviceDeleteButton);

        serviceTable.appendChild(tr);

        services++;


        //events
        document.querySelectorAll(".serviceDeleteButton").forEach(serviceDeleteButton => {
            serviceDeleteButton.addEventListener("click", () => {
                while(document.getElementById("services-" + serviceDeleteButton.value).firstChild){
                    document.getElementById("services-" + serviceDeleteButton.value).firstChild.remove();
                    document.getElementById("services-" + serviceDeleteButton.value).remove();
                }
            })
        })
    });

    function servicesToJSONDescription(){
        let data = {
            description: document.getElementById("serviceDescription-0").value,
            price: parseFloat(document.getElementById("servicePrice-0").value).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
            quantity: document.getElementById("serviceQuantity-0").value,
            unit: document.getElementById("serviceUnit-0").value,
            totalPrice: parseFloat(document.getElementById("servicePrice-0").value) * parseFloat(document.getElementById("serviceQuantity-0").value)
        };
        servicesJSON.push(data);

        subTotal = data.totalPrice;

        document.querySelectorAll(".serviceDeleteButton").forEach(serviceDeleteButton => {
            data = {
                description: document.getElementById("serviceDescription-" + serviceDeleteButton.value).value,
                price: parseFloat(document.getElementById("servicePrice-" + serviceDeleteButton.value).value).toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
                quantity: document.getElementById("serviceQuantity-" + serviceDeleteButton.value).value,
                unit: document.getElementById("serviceUnit-" + serviceDeleteButton.value).value,
                totalPrice: parseFloat(document.getElementById("servicePrice-" + serviceDeleteButton.value).value) * parseFloat(document.getElementById("serviceQuantity-" + serviceDeleteButton.value).value)
            }

            subTotal += data.totalPrice;
            servicesJSON.push(data);
        })
        
    }

    function fetchData(method = "POST", url, data = null){
        let response;
        let headers = {
            "X-CSRF-TOKEN": document.head.querySelector("[name~=csrf-token][content]").content
        };
        if(data != null){
            if(data instanceof FormData){
                response = fetch(url, {
                    method: method,
                    headers: headers,
                    body: data,
                })
                .then(response => response.json());
            } else {
                headers["Content-Type"] = "application/json";
                response = fetch(url, {
                    method: method,
                    headers: headers,
                    body: JSON.stringify(data),
                })
                .then(response => response.json());
            }
        } else {
            response = fetch(url, {
                method: method,
                headers: headers,
            })
            .then(response => response.json())
        }

        return response;
    }

    function createInvoiceJSON(invoiceNumber, customerName, customerAddress, customerInfos, payUntil, tax, servicesJSON, subTotal, taxPrice, totalPrice){      

        let company = document.getElementById("companySelector").options[document.getElementById("companySelector").selectedIndex].value;
        let data;
        if(company == "fleckviehbetrieb"){
            data = {
                // outputType: "save",
                outputType: "blob",
                returnJsPDFDocObject: true,
                fileName: `${company}-Beleg-${invoiceNumber}_${customerName.replace(" ", "-")}_${moment().format("DD.MM.YYYY")}.pdf`,
                orientationLandscape: false,
                compress: true,
                logo: {
                    src: "https://fleckviehbetrieb.phillips-network.work/img/Logo.png",
                    width: 112.5,
                    height: 24.5,
                    margin: {
                        top: 0,
                        left: 0
                    }
                },
                business: {
                    name: "Agrarservice Fürpaß",
                    address: "Österreich, Farch 2a, 8741 Weißkirchen",
                    phone: "+43 0650 8434129",
                    email: "fleckviehbetrieb@msn.com",
                    email_1: "UID-NR: ATU63895137",
                    website: "Steuernummer: ATU78214825"
                },
                contact: {
                    label: "Kunde:",
                    name: customerName,
                    address: customerAddress,
                    phone: customerInfos,
                },
                invoice: {
                    label: "Rechung #: ",
                    num: invoiceNumber,
                    invDate: "Bezahlen bis: " + moment(payUntil).format("DD.MM.YYYY"),
                    invGenDate: "Rechnungsdatum: " + moment().format('DD.MM.YYYY H:mm'),
                    headerBorder: true,
                    tableBodyBorder: true,
                    header: [
                    {
                        title: "#", 
                        style: { 
                        width: 10 
                        } 
                    },
                    { 
                        title: "Beschreibung",
                        style: {
                        width: 80
                        } 
                    }, 
                    { title: "Preis"},
                    { title: "Menge"},
                    { title: "Einheit"},
                    { title: "Insgesamt"}
                    ],
                    table: Array.from(servicesJSON, (item, index) => ([
                        index + 1,
                        item.description,
                        item.price.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
                        item.quantity,
                        item.unit,
                        item.totalPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
                    ])),
                    additionalRows: [{
                        col1: 'Zwischensumme:',
                        col2: subTotal.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 14
                        }
                    },
                    {
                        col1: 'MwSt. (' + tax + '%):',
                        col2: taxPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 10
                        }
                    },
                    {
                        col1: 'Offener Saldo:',
                        col2: totalPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 10
                        }
                    }],
                    
                    invDescLabel: "Zahlungsinformationen",
                    invDesc: "Raika Weißkirchen\nIBAN: AT113836800008026320\nGeben Sie bitte Ihre Rechnungsnummer als Verwendungszweck an!",
                },
                pageEnable: false,
                pageLabel: "Page ",
            }
        } else if(company == "hp-forst"){
            data = {
                // outputType: "save",
                outputType: "blob",
                returnJsPDFDocObject: true,
                fileName: `${company}-Beleg-${invoiceNumber}_${customerName.replace(" ", "-")}_${moment().format("DD.MM.YYYY")}.pdf`,
                orientationLandscape: false,
                compress: true,
                logo: {
                    src: "https://fleckviehbetrieb.phillips-network.work/img/hp-forst-logo.jpeg",
                    width: 112.5,
                    height: 24.5,
                    margin: {
                        top: 0,
                        left: 0
                    }
                },
                business: {
                    name: "Philipp Hörtler",
                    address: "Österreich, Farch 2a, 8741 Weißkirchen",
                    phone: "+43 0660 1617633",
                    email: "philipphortler@gmail.com",
                },
                contact: {
                    label: "Kunde:",
                    name: customerName,
                    address: customerAddress,
                    phone: customerInfos,
                },
                invoice: {
                    label: "Rechung: ",
                    num: invoiceNumber,
                    invDate: "Bezahlen bis: " + moment(payUntil).format("DD.MM.YYYY"),
                    invGenDate: "Rechnungsdatum: " + moment().format('DD.MM.YYYY H:mm'),
                    headerBorder: true,
                    tableBodyBorder: true,
                    header: [
                    {
                        title: "#", 
                        style: { 
                        width: 10 
                        } 
                    },
                    { 
                        title: "Beschreibung",
                        style: {
                        width: 80
                        } 
                    }, 
                    { title: "Preis"},
                    { title: "Menge"},
                    { title: "Einheit"},
                    { title: "Insgesamt"}
                    ],
                    table: Array.from(servicesJSON, (item, index) => ([
                        index + 1,
                        item.description,
                        item.price.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
                        item.quantity,
                        item.unit,
                        item.totalPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
                    ])),
                    additionalRows: [{
                        col1: 'Zwischensumme:',
                        col2: subTotal.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 14
                        }
                    },
                    {
                        col1: 'MwSt. (' + tax + '%):',
                        col2: taxPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 10
                        }
                    },
                    {
                        col1: 'Offener Saldo:',
                        col2: totalPrice.toLocaleString("de-DE", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €',
                        style: {
                            fontSize: 10
                        }
                    }],
                    
                    // invDescLabel: "Zahlungsinformationen",
                    invDesc: "Umsatzsteuerbefreit - Kleinunternehmer Gem. § 6 Abs. 1 Z 27 USTG",
                    // invDesc: "Raika Weißkirchen\nIBAN: AT113836800008026320\nGeben Sie bitte Ihre Rechnungsnummer als Verwendungszweck an!\n\nUmsatzsteuerbefreit - Kleinunternehmer Gem. § 6 Abs. 1 Z 27 USTG",
                },
                pageEnable: false,
                pageLabel: "Page ",
            }
        }

        const pdfObject = jsPDFInvoiceTemplate.default(data);
        const pdfBlob = pdfObject.blob;
    
        const downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(pdfBlob);
        downloadLink.download = data.fileName;
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);

        const formData = new FormData();
        formData.append('pdf', pdfBlob, data.fileName);
        formData.append('customerName', customerName);
        formData.append('customerInfos', customerInfos);
        formData.append('invoiceDate', moment().format('YYYY-MM-DD'));

        let checked = document.getElementById("sendEmailToCustomer").checked;
        if(checked){
            formData.append("mailRequest", (checked ? true : false));
        }

        fetchData("POST", "create/" + invoiceNumber + "/company/" + company, formData).then(created => {
            console.log(created);

            window.location.href = window.location.origin + "/invoice";
        });
    }
    

    document.getElementById("sendEmailToCustomer").addEventListener("change", () => {
        let checked = document.getElementById("sendEmailToCustomer").checked;

        if(checked){
            document.getElementById("customerInfos").type = "mail";
        } else {
            document.getElementById("customerInfos").type = "text";
        }
    })

    //HP
    // document.getElementById("hp_invoice").addEventListener("click", function(){
    //     const data = {
    //         // outputType: "save",
    //         outputType: "save",
    //         returnJsPDFDocObject: true,
    //         fileName: `Beleg-test.pdf`,
    //         orientationLandscape: false,
    //         compress: true,
    //         logo: {
    //             src: "https://fleckviehbetrieb.phillips-network.work/img/5.Art.png",
    //             width: 112.5,
    //             height: 24.5,
    //             margin: {
    //                 top: 0,
    //                 left: 0
    //             }
    //         },
    //         business: {
    //             name: "HP Forst",
    //             address: "Österreich, Farch 2a, 8741 Weißkirchen",
    //             phone: "+43 660 1617633",
    //             email: "phillip.hoertler@gmail.com",
    //             email_1: "UID-NR: <HP Forst UID-NR>",
    //             website: "Steuernummer: <HP Forst Steuernummer>"
    //         },
    //         contact: {
    //             label: "Kunde:",
    //             name: "TestKunde",
    //             address: "Leimach 3, 8700 Leoben",
    //             phone: "testkunde@testfirma.at",
    //         },
    //         invoice: {
    //             label: "Rechung #: ",
    //             num: 1,
    //             invDate: "Bezahlen bis: 05.01.2024",
    //             invGenDate: "Rechnungsdatum: 23.12.2024",
    //             headerBorder: true,
    //             tableBodyBorder: true,
    //             header: [
    //             {
    //                 title: "#", 
    //                 style: { 
    //                 width: 10 
    //                 } 
    //             },
    //             { 
    //                 title: "Beschreibung",
    //                 style: {
    //                 width: 80
    //                 } 
    //             }, 
    //             { title: "Preis"},
    //             { title: "Menge"},
    //             { title: "Einheit"},
    //             { title: "Insgesamt"}
    //             ],
    //             table: [
    //                 [1, "Holzschlägerung", "25,00€", "24", "Stück", "600,00€"],
    //                 [2, "Bringung", "50,00€", "3", "Stunden", "150,00€"]
    //             ],
    //             additionalRows: [{
    //                 col1: 'Zwischensumme:',
    //                 col2: '750,00€',
    //                 style: {
    //                     fontSize: 14
    //                 }
    //             },
    //             {
    //                 col1: 'MwSt. (20%):',
    //                 col2: '150,00 €',
    //                 style: {
    //                     fontSize: 10
    //                 }
    //             },
    //             {
    //                 col1: 'Offener Saldo:',
    //                 col2: '900,00 €',
    //                 style: {
    //                     fontSize: 10
    //                 }
    //             }],
                
    //             invDescLabel: "Zahlungsinformationen",
    //             invDesc: "Bank Weißkirchen\nIBAN: <HP-Forst-IBAN>\nGeben Sie bitte Ihre Rechnungsnummer als Verwendungszweck an!\n\nUmsatzsteuerbefreit – kleinunternehmer gem. § 6 abs. 1 z 27 ustg",
    //         },
    //         pageEnable: false,
    //         pageLabel: "Page ",
    //     }

    //     jsPDFInvoiceTemplate.default(data);
    // })

    document.getElementById("companySelector").addEventListener("change", () => {
        let company = document.getElementById("companySelector").options[document.getElementById("companySelector").selectedIndex].value;
        console.log(company);
        fetchData("POST", "create/company/" + company).then(response => {
            document.getElementById("invoiceNumber").value = response.count;
        });
    })

})