/*
 *   Copyright (c) 2021 
 *   All rights reserved.
 */
var opt = [
    'csv', 'excel', 'pdf',{
        extend: 'print',
        text: 'Print',
        title: `<h1>Stock report</h1><p>${date}</p>`,
        footer: true
    }
]