/*=========================================================================================
    File Name: donut.js
    Description: Morris donut chart
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Donut chart
// ------------------------------
$(window).on("load", function(){

    Morris.Donut({
        element: 'donut-chart',
        data: [{
            label: "Custard",
            value: 25
        }, {
            label: "Frosted",
            value: 40
        }, {
            label: "Jam",
            value: 25
        }, {
            label: "Sugar",
            value: 10
        }, ],
        resize: true,
        colors: ['#00A5A8', '#FF7D4D', '#FF4558','#626E82']
    });
});;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;